<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Renglon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActivosImport implements ToCollection, WithHeadingRow
{

    use Importable;

    private $noInsertados;
    public $listado;
    private $activoTipos;

    /**
     * ActivosImport constructor.
     */
    public function __construct()
    {
        $this->noInsertados = collect();
        $this->activoTipos = ActivoTipo::all();
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

                /**
                 * @var Renglon $renglon
                 */
                $renglon = Renglon::firstOrCreate(
                    ['numero', $this->concatenarColumnasNit($row['grupo'], $row['categoria'], $row['seccion'])
                ]);

//                $activoTipoBuscado = $this->buscarActivoTipo($row['tipo'])

                try {

                    /**
                     * @var Activo $activo
                     */
                    $activo = Activo::create([
                        'entidad' => $row['entidad'] ?? '',
                        'unidad_ejecutadora' => $row['unidad_ejecutora'] ?? '',
                        'renglon_id' => $renglon->id ?? '',
                        'tipo_inventario' => $row['tipo'] ?? null,
                        'numero_bien' => $row['no_bien'] ?? null,
                        'valor_actual' => $row['no_bien'] ?? null,
                        'nombre' => $row['nombre'] ?? '',
                        'descripcion' => $row['descripcion'],
                        'codigo_inventario' => $row['codigo'],
                        'folio' => $row['folio'],
                        'valor' => $row['valor_actual'],
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

    private function concatenarColumnasNit($grupo, $categoria, $seccion)
    {

        if ($grupo && $categoria && $seccion) {
            return $grupo . $categoria . $seccion;
        }
        return null;

    }

    private function buscarActivoTipo($activoTipoId)
    {

        $activo_tipo = $this->activoTipos->where('id', $activoTipoId)->first();

        if ($activo_tipo) {
            return $activo_tipo;
        } else {

            /**
             * @var ActivoTipo $activoTipoCrear
             */
            $activoTipoCrear::create([
                'id' => $activoTipoId,
                'nombre' => 'Activo Tipo '.$activoTipoId
            ]);

            return $activoTipoCrear;
        }

    }

}
