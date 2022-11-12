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
            'nombre' => 'ACTIVO SOLICITUD TIPO 1'
        ]);

        ActivoSolicitudTipo::firstOrCreate([
            'nombre' => 'ACTIVO SOLICITUD TIPO 2'
        ]);
    }
}
