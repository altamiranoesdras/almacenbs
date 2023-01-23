<?php

namespace App\Imports;

use App\Models\Item;
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

        foreach ($collection as $index => $fila) {


            if($fila['codigo_de_insumo'] && $fila['codigo_de_presentacion']){


                try {

                    /**
                     * @var Item $item
                     */
                    $item = Item::whereCodigoPresentacion($fila['codigo_de_presentacion'])
                        ->whereCodigoInsumo($fila['codigo_de_insumo'])
                        ->first();

                    $item->precio_compra = $fila['precio_unitario'];
                    $item->save();

                    $stock = $fila['saldo_actual'];

                    $item->actualizaOregistraStcokInicial($stock);

                }
                catch (\Exception $exception){

                    $nombre = $fila['nombre']." - CI: ".$fila['codigo_de_insumo']." - CP: ".$fila['codigo_de_presentacion'];

                    $this->errores->push([$nombre => $exception->getMessage()]);
                }


            }

        }

    }
}
