<?php

namespace Database\Seeders;

use App\Imports\ImportColaboradores;
use Illuminate\Database\Seeder;

class ImportUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importable = new ImportColaboradores();

        $importable->import(storage_path('imports/puestos_y_unidades.xlsx'));
    }
}
