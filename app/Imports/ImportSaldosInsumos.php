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

            $codigoInsumo = $fila[self::CODIGO_DE_INSUMO] ?? false;
            $codigoPresentacion = $fila[self::CODIGO_DE_PRESENTACION] ?? false;


            if ($codigoInsumo && $codigoPresentacion){

                try {


                    /**
                     * @var Item $item
                     */
                    $item = Item::whereCodigoPresentacion($fila[self::CODIGO_DE_PRESENTACION])
                        ->whereCodigoInsumo($fila[self::CODIGO_DE_INSUMO])
                        ->first();

                    if ($item){

                        $item->precio_compra = $fila[self::PRECIO_UNITARIO] ?? 0;
                        $item->save();

                        $stock = $fila[self::CANTIDAD] ?? 0;

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

            }



        }

        dump([
            'ingresados' => $ingresados,
            'noEncontrados' => $noEncontrados,
            'total' => $collection->count()
        ]);

    }
}
