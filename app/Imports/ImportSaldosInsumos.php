<?php

namespace App\Imports;

use App\Models\Item;
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

        $ingresados = 0;
        $noEncontrados= 0;
        $conteo = 0;

        foreach ($collection as $index => $fila) {


            if(($fila['codigo_de_insumo'] && $fila['codigo_de_presentacion'])){


                if ($fila['codigo_de_presentacion']!='N/A'){



                    try {


                        /**
                         * @var Item $item
                         */
                        $item = Item::whereCodigoPresentacion($fila['codigo_de_presentacion'])
                            ->whereCodigoInsumo($fila['codigo_de_insumo'])
                            ->first();


                        if ($item){

                            $item->precio_compra = $fila['precio_unitario'];
                            $item->save();

                            $stock = $fila['saldo_actual'];

                            $res = $item->actualizaOregistraStcokInicial($stock);

                            if ($res){
                                $ingresados++;
                            }

                        }else{

                            $nombre = $fila['nombre']." - CI: ".$fila['codigo_de_insumo']." - CP: ".$fila['codigo_de_presentacion'];

                            $this->errores->push([$nombre => "No se encontró"]);

                            $noEncontrados++;

                        }

                    }

                    catch (Exception $exception){

                        $nombre = $fila['nombre']." - CI: ".$fila['codigo_de_insumo']." - CP: ".$fila['codigo_de_presentacion'];

                        $this->errores->push([$nombre => $exception->getMessage()]);
                    }

                }else{


                    $nombre = $fila['nombre']." - CI: ".$fila['codigo_de_insumo']." - CP: ".$fila['codigo_de_presentacion'];

                    $this->errores->push([$nombre => "Renglon 122"]);
                }


            }



        }

        dump([
            'ingresados' => $ingresados,
            'noEncontrados' => $noEncontrados,
            'total' => $collection->count()
        ]);

    }
}
