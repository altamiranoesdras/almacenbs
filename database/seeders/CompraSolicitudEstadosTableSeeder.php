<?php

namespace Database\Seeders;

use App\Models\CompraSolicitudEstado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSolicitudEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        CompraSolicitudEstado::truncate();

        CompraSolicitudEstado::firstOrCreate(
            ['id' => 1],
            ['nombre' => 'Temporal']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 2],
            ['nombre' => 'Ingresada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 3],
            ['nombre' => 'Solicitada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 4],
            ['nombre' => 'Asignada a Requisición']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 5],
            ['nombre' => 'Cancelada']
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
