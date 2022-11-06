<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Renglon;
use Carbon\Carbon;
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


            if ($row['codigo'] || $row['descripcion'] || $row['fecha_registra']) {

                /**
                 * @var Renglon $renglon
                 */
                $renglon = Renglon::firstOrCreate([
                    'numero' => $this->concatenarColumnasNit($row['grupo'], $row['categoria'], $row['seccion'])
                ]);

                /**
                 * @var ActivoEstado $activoEstado
                 */
                $activoEstado = ActivoEstado::firstOrCreate([
                   'nombre' => $row['estado_inventario']
                ]);

                try {

                    /**
                     * @var Activo $activo
                     */
                    $activo = Activo::create([
                        'entidad' => $row['entidad'] ?? null,
                        'unidad_ejecutadora' => $row['unidad_ejecutora'] ?? null,
                        'renglon_id' => $renglon->id ?? null,
                        'tipo_inventario' => $row['tipo'] ?? null,
                        'numero_bien' => $row['no_bien'] ?? null,
                        'estado_id' => $activoEstado->id,
                        'descripcion' => $row['descripcion'],
                        'valor_actual' => $row['valor_actual'] ?? null,
                        'valor_adquisicion' => $row['valor_adquisicion'] ?? null,
                        'valor_contabilizado' => $row['valor_contabilizado'] ?? null,
                        'codigo_donacion' => $row['codigo_donacion'] ?? null,
                        'nit' => $row['nit'] ?? null,
                        'numero_documento' => $row['no_documento'] ?? null,
                        'fecha_registro' => Carbon::createFromFormat('m/d/Y h:i:s a', $row['fecha_registro'])->format('Y-m-d') ?? null,
                        'fecha_aprobado' => Carbon::createFromFormat('m/d/Y h:i:s a', $row['fecha_aprobado'])->format('Y-m-d') ?? null,
                        'fecha_contabilizacion' => Carbon::createFromFormat('m/d/Y h:i:s a', $row['fecha_contabilizacion'])->format('Y-m-d') ?? null,
                        'cur' => $row['cur'] ?? null,
                        'contabilizado' => $row['contabilizado'] ?? null,
                        'diferencia_act_adq' => $row['diferencia_act_adq'] ?? null,
                        'diferencia_act_cont' => $row['diferencia_act_cont'] ?? null,
                        'diferencia_adq_cont' => $row['diferencia_adq_cont'] ?? null,
                        'nombre' => mb_substr($row['descripcion'], 0, 25),
                        'codigo_inventario' => $row['codigo'] ?? null,
                        'folio' => $row['folio'] ?? null,
                        'valor' => $row['valor_actual'] ?? null,
                        'fecha_registra' => Carbon::createFromFormat('m/d/Y h:i:s a', $row['fecha_registro'])->format('Y-m-d'),
                        'tipo_id' => ActivoTipo::ACTIVO_FIJO,
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

}
