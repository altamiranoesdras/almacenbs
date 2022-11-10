<?php

namespace App\Imports;

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
}
