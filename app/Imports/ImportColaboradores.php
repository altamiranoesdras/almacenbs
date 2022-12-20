<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use App\Models\Bodega;
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



        $nombreCompleto = $row['nombres_y_apellidos'] ?? null;
        $nombrePuesto = $row['cargo'] ?? null;
        $nombreUnidad = $row['dependencia'] ?? null;
        $nombreBodega = $row['bodega'] ?? null;
        $direccionBodega = $row['direccion_de_sede'] ?? null;
        $correo = $row['correo_electronico_oficial'] ?? null;
        $telefonoDirecto = $row['telefono_directo'] ?? null;
        $celular_institucional = $row['celular_institucional'] ?? null;
        $extension = $row['extension'] ?? null;


        if ($nombreCompleto && $nombreUnidad){


            $unidad = RrhhUnidad::firstOrCreate(['nombre' => $nombreUnidad]);
            $puesto = RrhhPuesto::firstOrCreate(['nombre' => $nombrePuesto]);
            $bodega = Bodega::firstOrCreate([
                'nombre' => $nombreBodega,
                'direccion' => $direccionBodega,
                'telefono' => $telefonoDirecto ?? $celular_institucional
            ]);


            $nombreUsuario = generaNombreUsuario($nombreCompleto);

            /**
             * @var User $usuario
             */
            $usuario = User::firstOrCreate([
                'username' => $nombreUsuario,
                'name' => $nombreCompleto,
                'email' => $correo,
                'password' => bcrypt(123456),
                'unidad_id' => $unidad->id,
                'puesto_id' => $puesto->id,
                'bodega_id' => $bodega->id,
            ]);

            $usuario->syncRoles(['General']);
            $usuario->shortcuts()->sync([
                Option::MIS_REQUISICIONES,
                Option::NUEVA_REQUISICION,
            ]);


            list($nombres,$apellidos) = separaNombreCompleto($nombreCompleto);


            try {

                /**
                 * @var Colaborador $colaborador
                 */
                $colaborador = Colaborador::firstOrCreate([
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'dpi' => $dpi ?? null,
                    'correo' => $correo,
                    'telefono' => $telefonoDirecto ?? $celular_institucional,
                    'direccion' => null,
                    'nit' => $nit ?? null,
                    'puesto_id' => $puesto->id,
                    'unidad_id' => $unidad->id,
                    'user_id' => $usuario->id
                ]);

//                $this->crearTarjeta($colaborador);

//                $contrato = Contrato::firstOrCreate([
//                    'colaborador_id' => $colaborador->id,
//                    'unidad_id' => $unidad->id,
//                    'puesto_id' => null,
//                    'numero' => $numeroContrato,
//                    'inicio' => Carbon::parse($del),
//                    'fin' => Carbon::parse($al)
//                ]);

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
