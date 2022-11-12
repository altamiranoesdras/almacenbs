<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use App\Models\Colaborador;
use App\Models\Contrato;
use App\Models\Option;
use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportColaboradores implements ToModel , WithHeadingRow
{

    use Importable,RemembersRowNumber;

    public function model(array $row)
    {



        $nombreCompleto = $row['nombre'] ?? null;
        $nombreUnidad = $row['ubicacion'] ?? null;
        $nit = $row['numero_de_identificacion_tributaria_nit'] ?? null;
        $dpi = $row['codigo_unico_de_identificacion_cui'] ?? null;
        $numeroContrato = $row['numero_de_contrato'] ?? null;
        $del = $row['del'] ?? null;
        $al = $row['al'] ?? null;


        if ($nombreCompleto && $nombreUnidad){


            $unidad = RrhhUnidad::firstOrCreate(['nombre' => $row['ubicacion']]);

            list($nombres,$apellidos) = separaNombreCompleto($nombreCompleto);


            try {

                /**
                 * @var Colaborador $colaborador
                 */
                $colaborador = Colaborador::firstOrCreate([
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'dpi' => $dpi,
                    'correo' => null,
                    'telefono' => null,
                    'direccion' => null,
                    'nit' => $nit,
                    'puesto_id' => null,
                    'unidad_id' => $unidad->id,
                    'user_id' => null
                ]);

//                $this->crearTarjeta($colaborador);

                $contrato = Contrato::firstOrCreate([
                    'colaborador_id' => $colaborador->id,
                    'unidad_id' => $unidad->id,
                    'puesto_id' => null,
                    'numero' => $numeroContrato,
                    'inicio' => Carbon::parse($del),
                    'fin' => Carbon::parse($al)
                ]);

            }catch (\Exception $exception){
                dump('Error en fila',$this->getRowNumber());
                dd($exception->getMessage());
            }

        }
    }

    public function crearTarjeta(Colaborador $colaborador)
    {
        $detalles = Activo::where('nit',$colaborador->nit)->get()->map(function (Activo $activo) use ($colaborador){
             return new ActivoTarjetaDetalle([
                 'activo_id' => $activo->id,
                 'tipo' => $activo->tipo->id,
                 'cantidad' => 1,
                 'valor' => $activo->valor,
                 'fecha_asigna' => $activo->fecha_registro,
                 'unidad_id' => $colaborador->unidad->id
             ]);
        });

        /**
         * @var ActivoTarjeta $tarjeta
         */
        $tarjeta = ActivoTarjeta::create([
            'colaborador_id' => $colaborador->id,
            'codigo_interno' => "",
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
        ]);

        $tarjeta->detalles()->saveMany($detalles);
    }


    public function getCodigo($cantidadCeros = 1)
    {
        return prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = ActivoTarjeta::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }
}
