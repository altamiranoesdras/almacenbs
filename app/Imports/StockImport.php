<?php

namespace App\Imports;

use App\Models\Bodega;
use App\Models\ItemCategoria;
use App\Models\Item;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Stock;
use App\Models\Unimed;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StockImport implements ToCollection, WithHeadingRow
{

    use Importable;

    const BODEGA = "cajbodega";
    const CODIGO_DE_INSUMO = "codigo_de_insumo";
    const CODIGO_DE_PRESENTACION = "codigo_de_presentacion";
    const DESCRIPCION = "descripcion";
    const PRECIO_COMPRA = "precio_compra";
    const EXISTENCIAS_ACTUALES = "existencias_actuales";



    private $errores;
    private $bodegas;
    private $totalRegistros;

    /**
     * ItemsImport constructor.
     */
    public function __construct()
    {
        $this->noInsertados = collect();
        $this->errores = collect();
        $this->bodegas = Bodega::all();
        $this->totalRegistros = 0;

    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        $this->totalRegistros = $rows->count();


        foreach ($rows as $index => $row) {


            $nombreBodega = $row[self::BODEGA] ?? '';
            $codigoInsumo = $row[self::CODIGO_DE_INSUMO] ?? '';
            $codigoPresentacion = $row[self::CODIGO_DE_PRESENTACION] ?? '';
            $descripcion = $row[self::DESCRIPCION] ?? '';
            $precioCompra = $row[self::PRECIO_COMPRA] ?? '';
            $existenciasActuales = $row[self::EXISTENCIAS_ACTUALES] ?? '';




            if($codigoInsumo!='' && $codigoPresentacion!='' && $precioCompra!='' && $existenciasActuales!=''){


                /**
                 * @var Bodega $bodega
                 */
                $bodega = $this->bodegas->where('nombre',$nombreBodega)->first() ?? null;




                /**
                 * @var Item $item
                 */
                $item = Item::whereCodigoInsumo($codigoInsumo)->whereCodigoPresentacion($codigoPresentacion)->first();

//                dump($bodega->nombre,$item->id,$precioCompra,$existenciasActuales);

                try {

                    $this->validarBodegas($row,$bodega);

                    Stock::updateOrCreate([
                        'bodega_id' => $bodega->id,
                        'item_id' => $item->id,
                        'precio_compra' => $precioCompra,
                    ],[
                        'bodega_id' => $bodega->id,
                        'item_id' => $item->id,
                        'cantidad' => $existenciasActuales,
                        'cantidad_inicial' => $existenciasActuales,
                        'precio_compra' => $precioCompra,
                        'fecha_vence' => null,
                        'lote' => null,
                    ]);
                }
                catch (\Exception $exception){
                    $this->errores->push($exception->getMessage());
                }



            }



        }

//        dd('fin');



    }

    public function getErrores(){
        return $this->errores;
    }


    /**
     * @param $fila
     * @param Bodega|null $bodega
     * @return mixed
     * @throws \Exception
     */
    public function validarBodegas($fila,$bodega)
    {

            $nombreBodega = $fila[self::BODEGA] ?? '';

            if(!$bodega){
                throw new \Exception('La bodega '.$nombreBodega.' no existe');
            }

            if($bodega->id == Bodega::PRINCIPAL){

                throw new \Exception('La bodega no puede ser la principal');
            }

            return $bodega;

    }

}
