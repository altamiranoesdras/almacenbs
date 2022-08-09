<?php

namespace App\Imports;

use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUsusarios implements ToModel , WithHeadingRow
{

    use Importable;

    public function model(array $row)
    {



        $nombreCompleto = $row['nombre_completo'] ?? null;
        $nombrePuesto = $row['puesto_nominal'] ?? null;
        $nombreUnidad = $row['ubicacion'] ?? null;


        if ($nombreCompleto && $nombrePuesto && $nombreUnidad){

            $usuario = generaNombreUsuario($nombreCompleto);


            $puesto = RrhhPuesto::firstOrCreate(['nombre' => $row['puesto_nominal']]);
            $unidad = RrhhUnidad::firstOrCreate(['nombre' => $row['ubicacion']]);


            /**
             * @var User $usuario
             */
            $usuario = User::firstOrCreate([
                'username' => $usuario,
                'name' => $nombreCompleto,
                'email' => null,
                'password' => bcrypt(123456),
                'unidad_id' => $unidad->id,
                'puesto_id' => $puesto->id,
            ]);

            $usuario->syncRoles(['General']);
        }
    }
}
