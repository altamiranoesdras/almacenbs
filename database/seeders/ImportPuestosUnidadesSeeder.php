<?php

namespace Database\Seeders;

use App\Imports\ImportPuestosUnidades;
use Illuminate\Database\Seeder;

class ImportPuestosUnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importable = new ImportPuestosUnidades();

        $importable->import(storage_path('imports/puestos_y_unidades.xlsx'));
    }
}
