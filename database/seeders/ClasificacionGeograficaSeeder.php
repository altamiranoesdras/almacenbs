<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasificacionGeograficaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RegionsTableSeeder::class,
            DepartamentosTableSeeder::class,
            MunicipiosTableSeeder::class,
        ]);
    }
}
