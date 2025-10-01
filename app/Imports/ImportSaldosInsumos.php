<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\ItemCategoria;
use App\Models\ItemPresentacion;
use App\Models\ItemTipo;
use App\Models\Renglon;
use App\Models\RrhhUnidad;
use App\Models\Unimed;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ImportSaldosInsumos implements ToCollection,WithHeadingRow,WithProgressBar
{

    use Importable;


    public $errores;


    const CODIGO_DE_INSUMO ="codigo_de_insumo";
    const CODIGO_DE_PRESENTACION ="codigo_de_presentacion";
    const RENGLON ="renglon";
    const NOMBRE ="nombre";
    const CARACTERISTICAS ="caracteristicas";
    const NOMBRE_DE_LA_PRESENTACION ="nombre_de_la_presentacion";
    const CANTIDAD_Y_UNIDAD_DE_MEDIDA_DE_LA_PRESENTACION ="cantidad_y_unidad_de_medida_de_la_presentacion";
    const CANTIDAD ="cantidad";
    const PRECIO_UNITARIO ="precio_unitario";
    const TOTAL ="total";
    const FECHA_DE_INGRESO ="fecha_de_ingreso";
    const FECHA_DE_VENCIMIENTO ="fecha_de_vencimiento";
    const CATEGORIA ="categoria";
    const CODIGO_DE_UNIDAD ="codigo_de_unidad";
    const UNIDAD ="unidad";


    public $nuevos = 0;
    public $acutalizados = 0;


    /**
     * ImportSaldosInsumos constructor.
     */
    public function __construct()
    {
        $this->errores = collect();
    }


    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {


        foreach ($collection as $index => $fila) {


            $codigoInsumo = trim($fila[self::CODIGO_DE_INSUMO] ?? '');
            $codigoPresentacion = trim($fila[self::CODIGO_DE_PRESENTACION] ?? '');

            $nombrePresentacion = trim($fila[self::NOMBRE_DE_LA_PRESENTACION] ?? '');
            $nombreUnidad = trim($fila[self::CANTIDAD_Y_UNIDAD_DE_MEDIDA_DE_LA_PRESENTACION] ?? '');
            $precionCompra = $fila[self::PRECIO_UNITARIO] ?? 0;
            $descripcion = trim($fila[self::CARACTERISTICAS] ?? '');

            $nombreCategoria = trim($fila[self::CATEGORIA] ?? '');
            $stock = $fila[self::CANTIDAD] ?? 0;
            $nombreInsumo = trim($fila[self::NOMBRE] ?? '');
            $codigoRenglon = trim($fila[self::RENGLON] ?? null);
            $tipoId = null;

            if ($codigoRenglon>=200 && $codigoRenglon<300){
                $tipoId = ItemTipo::MATERIALES_SUMINISTROS;
            }elseif ($codigoRenglon>=300 && $codigoRenglon<400){
                $tipoId = ItemTipo::ACTIVO_FIJO;
            }


            $presentacion = ItemPresentacion::firstOrCreate(['nombre' => $nombrePresentacion]);
            $unidadMedida = Unimed::firstOrCreate(['nombre' => $nombreUnidad ]);
            $categoria = ItemCategoria::firstOrCreate(['nombre' => $nombreCategoria ]);
            $renglon = Renglon::firstOrCreate(['numero' => $codigoRenglon]);
            $codigoUnidad = trim($fila[self::CODIGO_DE_UNIDAD] ?? '');
            $rrhhUnidad = RrhhUnidad::where('codigo',$codigoUnidad)->first();
            $fechaVencimiento = $this->formatFechaVence($fila[self::FECHA_DE_VENCIMIENTO] ?? null);

            if ($codigoInsumo && $codigoPresentacion){

                try {

                    $item = Item::whereCodigoPresentacion($codigoPresentacion)
                        ->whereCodigoInsumo($codigoInsumo)
                        ->first();

                    //Actualizo Insumo
                    if ($item){

                        $item->precio_compra = $precionCompra;
                        $item->descripcion = $descripcion;
                        $item->unimed_id = $unidadMedida->id;
                        $item->presentacion_id = $presentacion->id;
                        $item->categoria_id = $categoria->id;
                        $item->tipo_id = $tipoId;

                        $item->save();

                        $this->acutalizados++;

                    }
                    //Creo Insumo
                    else{

                        $item = Item::create([
                            'codigo' => null,
                            'codigo_insumo' => $codigoInsumo,
                            'codigo_presentacion' => $codigoPresentacion,
                            'nombre' => $nombreInsumo,
                            'descripcion' => $descripcion,
                            'tipo_id' => $tipoId ?? ItemTipo::MATERIALES_SUMINISTROS,
                            'renglon_id' => $renglon->id,
                            'marca_id' => null,
                            'unimed_id' => $unidadMedida->id,
                            'presentacion_id' => $presentacion->id,
                            'categoria_id' => $categoria->id,
                            'precio_venta' => 0,
                            'precio_compra' => $precionCompra,
                            'precio_promedio' => $precionCompra,
                            'stock_minimo' => 0,
                            'stock_maximo' => 0,
                            'ubicacion' => '',
                            'inventariable' => 1,
                            'perecedero' => 1,
                        ]);

                        $this->nuevos++;

                    }

                    //Asocio categoria
                    $item->categorias()->sync([$categoria->id]);

                    //Registro stock inicial
                    $res = $item->actualizaOregistraStcokInicial($stock,$fechaVencimiento,$rrhhUnidad->id);


                }

                catch (Exception $exception){

                    $nombre = $fila['nombre']." - CI: ".$fila['codigo_de_insumo']." - CP: ".$fila['codigo_de_presentacion'];

                    $this->errores->push([$nombre => $exception->getMessage()]);
                }

            }else{
                $this->errores->push(["Fila ".($index+2) => "Faltan datos obligatorios. Código de insumo y código de presentación son obligatorios."]);
            }

        }

    }

    public function formatFechaVence($fecha)
    {
        if ($fecha=='N/A')
            return null;

        try {
            if (is_numeric($fecha)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha)->format('Y-m-d');
            } else {
                return date('Y-m-d', strtotime($fecha));
            }
        } catch (Exception $e) {
            return null;
        }

    }
}
