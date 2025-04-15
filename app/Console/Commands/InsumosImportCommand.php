<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\ItemPresentacion;
use App\Models\ItemTipo;
use App\Models\Renglon;
use App\Models\Unimed;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use League\Csv\ResultSet;
use League\Csv\Statement;
use Maatwebsite\Excel\Validators\ValidationException;

class InsumosImportCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:insumos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importar insumos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->inicio();

        deshabilitaLlavesForaneas();

        Item::truncate();
        Unimed::truncate();
        ItemPresentacion::truncate();
        Renglon::truncate();
        DB::table('item_has_categoria')->truncate();
        DB::table('stocks')->truncate();
        DB::table('stocks_transacciones')->truncate();
        DB::table('kardexs')->truncate();
        DB::table('compras')->truncate();
        DB::table('compra_detalles')->truncate();

//        Artisan::call('db:seed', [
//            '--class' => 'RenglonesTableSeeder',
//        ]);
//
        $this->output->info('Tablas truncadas y seeder ejecutados');

        $path = storage_path('imports/CATALOGO DE INSUMOS AL 07042025.csv');
        $original = file_get_contents($path);

        // Convierte a UTF-8 (desde ISO-8859-1 o Windows-1252)
        $utf8 = mb_convert_encoding($original, 'UTF-8', 'ISO-8859-1');

        $csv = Reader::createFromString($utf8);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(1);

        $headers = array_filter($csv->getHeader());
        $records = (new Statement())->process($csv, $headers);

        $total = count($records);

        $datos = $this->getColeccionColumna($records,'RENGLÓN');
        $renglones = $this->insertMasivo($datos,'numero',Renglon::class);

        $datos = $this->getColeccionColumna($records,'NOMBRE DE LA PRESENTACIÓN');
        $presentaciones = $this->insertMasivo($datos,'nombre',ItemPresentacion::class);

        $datos = $this->getColeccionColumna($records,'CANTIDAD Y UNIDAD DE MEDIDA DE LA PRESENTACIÓN');
        $unidades = $this->insertMasivo($datos,'nombre',Unimed::class);


        try {

            $this->barraProcesoIniciar($total);

            foreach ($records as $i => $fila) {
                if ($i == 0) {
                    continue;
                }

                $this->barraProcesoAvanzar();

                $codigoRenglon = $fila['RENGLÓN'] ?? null;
                $codigoInsumo = $fila['CÓDIGO DE INSUMO'] ?? null;
                $nombre = $fila['NOMBRE'] ?? null;
                $caracteristicas = $fila['CARACTERÍSTICAS'] ?? null;
                $nombrePresentacion = $fila['NOMBRE DE LA PRESENTACIÓN'] ?? null;
                $cantidadYUnidad = $fila['CANTIDAD Y UNIDAD DE MEDIDA DE LA PRESENTACIÓN'] ?? null;
                $codigoPresentacion = $fila['CÓDIGO DE PRESENTACIÓN'] ?? null;

                $renglon = $renglones->where('numero', $codigoRenglon)->first() ?? null;
                $presentacion = $presentaciones->where('nombre', $nombrePresentacion)->first() ?? null;
                $unimed = $unidades->where('nombre', $cantidadYUnidad)->first() ?? null;

                $item = Item::updateOrCreate(
                    [
                        'codigo_insumo' => $codigoInsumo,
                        'codigo_presentacion' => $codigoPresentacion,
                    ],
                    [
//                            'codigo' => null,
                        'codigo_insumo' => $codigoInsumo,
                        'codigo_presentacion' => $codigoPresentacion,
                        'nombre' => $nombre,
                        'renglon_id' => $renglon->id ?? null,
                        'presentacion_id' => $presentacion->id ?? null,
                        'descripcion' => $caracteristicas ?? null,
                        'precio_compra' => 0,
                        'precio_promedio' => 0,
                        'inventariable' => 1,
                        'tipo_id' => ItemTipo::MATERIALES_SUMINISTROS,
                        'perecedero' => 0,
                        'marca_id' => $marca->id ?? null,
                        'unimed_id' => $unimed->id ?? null,
                        'categoria_id' => $categoria->id ?? null,
                    ]
                );

            }

            $this->barraProcesoFin();

        }
        catch (ValidationException $e) {

            DB::rollBack();
            $erros = array();
            foreach ($e->failures() as $failure) {
                $erros[] = "Error en fila ".$failure->row().": ".implode($failure->errors());
            }

            Log::error($e->getMessage(),$erros);

        }
        catch (Exception $e){

            Log::error($e->getMessage());
            dd($e->getMessage());


        }


        $this->fin();
        $this->output->success('Importación Exitosa!');

        habilitaLlavesForaneas();


    }

    public function getColeccionColumna(ResultSet $records, $columna): \Illuminate\Support\Collection
    {
        $coleccion = collect();

        foreach ($records as $i => $fila) {
            if ($i == 0) {
                continue; // salta cabecera
            }

            $valor = $fila[$columna] ?? null;


            if ($valor) {
                $valorLimpio = trim($valor);

                $coleccion->push($valorLimpio);
            }
        }

        return $coleccion->unique(function ($item) {
            $item = mb_strtolower($item);
            $item = str_replace(
                ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'],
                ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'],
                $item
            );
            return $item;
        });
    }


    public function insertMasivo(Collection $collection,$campo,$modelo)
    {

        $datos = [];

        foreach ($collection as $i => $valor) {
            $datos[] = [
                $campo => trim($valor),
            ];
        }

        $modelo::insert($datos);

        return $modelo::all();
    }
}
