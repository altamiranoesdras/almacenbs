<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Renglon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActivosImport implements ToModel, WithHeadingRow,WithBatchInserts,WithChunkReading
{

    use Importable,RemembersRowNumber;

    private $noInsertados;
    public $listado;
    private $activoTipos;
    private $estados;
    private $renglones;
    private $limite;
    private $total;

    /**
     * ActivosImport constructor.
     */
    public function __construct()
    {
        $this->limite = 10000;
        $this->noInsertados = collect();
        $this->activoTipos = ActivoTipo::all();
        $this->estados = ActivoEstado::all();
        $this->renglones = Renglon::all();
        $this->total = 0;
    }



    public function model(array $row)
    {


        if ($row['codigo'] || $row['descripcion'] || $row['fecha_registro']) {

            /**
             * @var Renglon $renglon
             */
            $renglon = $this->renglones->where('numero',$this->getRenglon($row))->first();

            if (!$renglon){
                $renglon = Renglon::firstOrCreate(['numero' => $this->getRenglon($row)]);
            }

            /**
             * @var ActivoEstado $activoEstado
             */
            $activoEstado = $this->estados->where('nombre',$row['estado_inventario'])->first();

            try {

                DB::table('activos')->insert([
                    'entidad' => $row['entidad'] ?? null,
                    'unidad_ejecutadora' => $row['unidad_ejecutora'] ?? null,
                    'renglon_id' => $renglon->id ?? null,
                    'tipo_inventario' => $row['tipo'] ?? null,
                    'codigo_sicoin' => $row['codigo'] ?? null,
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
                    'codigo_inventario' => $row['no_bien'] ?? null,
                    'folio' => $row['folio'] ?? null,
                    'valor' => $row['valor_actual'] ?? null,
                    'fecha_registro' => Carbon::createFromFormat('m/d/Y h:i:s a', $row['fecha_registro'])->format('Y-m-d'),
                    'tipo_id' => ActivoTipo::ACTIVO_FIJO,
                ]);

            } catch (\Exception $exception) {

                dump($exception->getMessage());
                $this->noInsertados->push([$row['descripcion'] => $exception->getMessage()]);

            }

        }
    }



    public function getNoInsertados(){
        return $this->noInsertados;
    }

    private function getRenglon($fila)
    {

        if ($fila['grupo'] && $fila['categoria'] && $fila['seccion']) {
            return $fila['grupo'] . $fila['categoria'] . $fila['seccion'];
        }

        return null;

    }

    public function batchSize(): int
    {
        return $this->limite;
    }

    public function chunkSize(): int
    {
        return $this->limite;
    }


}
