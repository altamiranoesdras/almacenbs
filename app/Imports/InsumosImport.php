<?php

namespace App\Imports;

use App\Models\ItemCategoria;
use App\Models\Item;
use App\Models\ItemPresentacion;
use App\Models\ItemTipo;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Unimed;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class InsumosImport implements ToCollection, WithHeadingRow, WithProgressBar
{

    use Importable;


    private $faker;
    private $noInsertados;
    private $codigosExistentes;

    /**
     * ItemsImport constructor.
     */
    public function __construct()
    {
        $this->noInsertados = collect();
        $this->codigosExistentes = collect();
        $this->faker = $this->withFaker();


    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {


        foreach ($rows as $index => $row) {


            $renglon = null;
            $unimed = null;
            $presentacion = null;



            if($row['nombre'] && $row['codigo_de_insumo'] && $row['codigo_de_presentacion']){


                if ($row['nombre_de_la_presentacion']!='') {

                    $presentacion = ItemPresentacion::firstOrCreate([
                                        'nombre' => $row['nombre_de_la_presentacion']
                                    ]);

                }

                if ($row['renglon']!='') {

                    $renglon = Renglon::firstOrCreate(['numero' => $row['renglon']]);
                }

                if ($row['cantidad_y_unidad_de_medida_de_la_presentacion']!='') {
                    $unimed = Unimed::firstOrCreate(['simbolo' => 'U','nombre' => $row['cantidad_y_unidad_de_medida_de_la_presentacion'],'magnitud_id' => 1]);
                }



                try {

                    $precio_compra = $this->faker->randomFloat(2,10,50);
                    $precio_venta = $precio_compra * 1.3;

                    /**
                     * @var Item $item
                     */
                    $item = Item::updateOrCreate(
                        [
                            'codigo_insumo' => $row['codigo_de_insumo'] ?? '',
                            'codigo_presentacion' => $row['codigo_de_presentacion'] ?? '',
                        ],
                        [
//                            'codigo' => null,
                            'codigo_insumo' => $row['codigo_de_insumo']=='' ? null : $row['codigo_de_insumo'],
                            'nombre' => $row['nombre'],
                            'renglon_id' => $renglon->id ?? null,
                            'presentacion_id' => $presentacion->id ?? null,
                            'descripcion' => $row['caracteristicas'] ?? null,
                            'precio_compra' => $row['precio_compra'] ?? $precio_compra,
                            'precio_promedio' => $row['precio_promedio'] ?? $precio_compra,
                            'ubicacion' => $row['ubicacion']  ?? null,
                            'inventariable' => 1,
                            'tipo_id' => rand(1,3),
                            'perecedero' => $row['perecedero'] ?? 0,
                            'marca_id' => $marca->id ?? null,
                            'unimed_id' => $unimed->id ?? null,
                            'categoria_id' => $categoria->id ?? null,
                        ]
                    );




                    $stock = $row['stockexistencias'] ?? rand(20,40);

                    $fechaVence = Carbon::now()->addMonths(rand(4,12))->format('Y-m-d');

                    $item->actualizaOregistraStcokInicial($stock,$fechaVence);

                }
                catch(QueryException $e){


                    dd($e->getMessage());
                    //Duplicate entry
                    if($e->errorInfo[1] == '1062'){
                        $this->codigosExistentes->push($row['codigo']." / ".$row['nombre']);
                    }
                }
                catch (\Exception $exception){
                    dd($e->getMessage());

                    $this->noInsertados->push([$row['nombre'] => $exception->getMessage()]);
                }



            }

        }


    }

    public function getCodigosExistentes(){
        return $this->codigosExistentes;
    }

    public function getNoInsertados(){
        return $this->noInsertados;
    }

}
