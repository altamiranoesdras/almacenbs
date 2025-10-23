<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();
        Region::truncate();

        $regiones = [
            ['codigo' => '01', 'nombre' => 'Región I, Metropolitana'],
            ['codigo' => '02', 'nombre' => 'Región II, Norte'],
            ['codigo' => '03', 'nombre' => 'Región III, Nororiente'],
            ['codigo' => '04', 'nombre' => 'Región IV, Suroriente'],
            ['codigo' => '05', 'nombre' => 'Región V, Central'],
            ['codigo' => '06', 'nombre' => 'Región VI, Suroccidente'],
            ['codigo' => '07', 'nombre' => 'Región VII, Noroccidente'],
            ['codigo' => '08', 'nombre' => 'Región VIII, Petén'],
            ['codigo' => '09', 'nombre' => 'Multiregional'],
            ['codigo' => '10', 'nombre' => 'Servicios en el exterior *'],
            ['codigo' => '11', 'nombre' => 'Deuda Pública *'],
        ];

        foreach ($regiones as $region) {
            Region::create($region);
        }
    }
}
