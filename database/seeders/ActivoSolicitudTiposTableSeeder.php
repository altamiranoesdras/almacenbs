<?php

namespace Database\Seeders;

use App\Models\ActivoSolicitudTipo;
use Illuminate\Database\Seeder;

class ActivoSolicitudTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivoSolicitudTipo::firstOrCreate([
            'id' => 1,
            'nombre' => 'TRASLADO DE PERSONA A BODEGA'
        ]);

        ActivoSolicitudTipo::firstOrCreate([
            'id' => 2,
            'nombre' => 'TRASLADO DE BODEGA A PERSONA'
        ]);

        ActivoSolicitudTipo::firstOrCreate([
            'id' => 3,
            'nombre' => 'TRASLADO DE PERSONA A PERSONA'
        ]);
    }
}
