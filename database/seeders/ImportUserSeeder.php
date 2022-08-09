<?php

namespace Database\Seeders;

use App\Imports\ImportUsusarios;
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
        $importable = new ImportUsusarios();

        $importable->import(storage_path('imports/puestos_y_unidades.xlsx'));
    }
}
