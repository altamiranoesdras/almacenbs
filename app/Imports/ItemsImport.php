<?php

namespace App\Imports;

use App\Models\ItemCategoria;
use App\Models\Item;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Unimed;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToCollection, WithHeadingRow
{

    use Importable;


    private $noInsertados;
    private $codigosExistentes;

    /**
     * ItemsImport constructor.
     */
    public function __construct()
    {
        $this->noInsertados = collect();
        $this->codigosExistentes = collect();

    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {


        foreach ($rows as $index => $row) {

            $marca = null;
            $unimed = null;
            $categoria = null;



            if($row['nombre'] && $row['precio_compra'] && $row['stockexistencias']!==''){


                if ($row['marca']!='') {

                    $marca = Marca::firstOrCreate(['nombre' => $row['marca']]);
                }
                if ($row['unidad_medida']!='') {
                    $unimed = Unimed::firstOrCreate(['simbolo' => 'U','nombre' => $row['unidad_medida'],'magnitud_id' => 1]);
                }

                if ($row['categoria']!=''){
                    $categoria = ItemCategoria::firstOrCreate(['nombre' => $row['categoria']]);
                }

                if ($row['renglon']!=''){
                    $renglon = Renglon::firstOrCreate(['numero' => $row['renglon']]);
                }


                try {

                    /**
                     * @var Item $item
                     */
                    $item = Item::updateOrCreate(
                        [
                            'codigo' => $row['codigo'] ?? '',
                            'nombre' => $row['nombre'],
                        ],
                        [
                            'codigo' => $row['codigo']=='' ? null : $row['codigo'],
                            'nombre' => $row['nombre'],
                            'renglon_id' => $renglon->id ?? null,
                            'descripcion' => $row['descripcion'] ?? null,
                            'precio_compra' => $row['precio_compra'] ?? 0,
                            'precio_promedio' => $row['precio_promedio'] ?? 0,
                            'ubicacion' => $row['ubicacion']  ?? null,
                            'inventariable' => $row['servicio_o_producto']=="Producto" ? 1 : 0,
                            'perecedero' => $row['perecedero'] ?? 0,
                            'marca_id' => $marca->id ?? null,
                            'unimed_id' => $unimed->id ?? null,
                            'categoria_id' => $categoria->id ?? null,
                        ]);

                    if ($categoria && $item){

                        $item->categorias()->syncWithoutDetaching([$categoria->id]);
                    }


                    $stockCant = $row['stockexistencias'] ?? 0;


                    $item->actualizaOregistraStcokInicial($stockCant);

                }
                catch(QueryException $e){

                    //Duplicate entry
                    if($e->errorInfo[1] == '1062'){
                        $this->codigosExistentes->push($row['codigo']." / ".$row['nombre']);
                    }
                }
                catch (\Exception $exception){
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
