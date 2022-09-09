<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActivosImport implements ToCollection, WithHeadingRow
{

    use Importable;

    private $noInsertados;
    public $listado;

    /**
     * ActivosImport constructor.
     */
    public function __construct()
    {
        $this->noInsertados = collect();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $index => $row) {


            if ($row['codigo_inventario'] || $row['descripcion'] || $row['fecha_registra']) {

                try {

                    /**
                     * @var Activo $activo
                     */
                    $activo = Activo::create([
                        'nombre' => $row['nombre'] ?? '',
                        'descripcion' => $row['descripcion'],
                        'codigo_inventario' => $row['codigo_inventario'],
                        'folio' => $row['folio'],
                        'valor' => $row['valor'],
                        'fecha_registra' => $row['fecha_registra'],
                        'tipo_id' => ActivoTipo::ACTIVO_FIJO,
                        'estado_id' => ActivoEstado::BUEN_ESTADO
                    ]);

                } catch (\Exception $exception) {

                    $this->noInsertados->push([$row['descripcion'] => $exception->getMessage()]);

                }

            }

        }

    }

    public function getNoInsertados(){
        return $this->noInsertados;
    }

}
