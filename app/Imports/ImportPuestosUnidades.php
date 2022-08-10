<?php

namespace App\Imports;

use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPuestosUnidades implements ToModel , WithHeadingRow
{

    use Importable;

    public function model(array $row)
    {


        $nombrePuesto = $row['puesto_nominal'] ?? null;
        $nombreUnidad = $row['ubicacion'] ?? null;


        if ($nombrePuesto && $nombreUnidad){

            $puesto = RrhhPuesto::firstOrCreate(['nombre' => $row['puesto_nominal']]);
            $unidad = RrhhUnidad::firstOrCreate(['nombre' => $row['ubicacion']]);


        }
    }
}
