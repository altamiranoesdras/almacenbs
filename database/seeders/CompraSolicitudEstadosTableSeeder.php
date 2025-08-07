<?php

namespace Database\Seeders;

use App\Models\CompraSolicitudEstado;
use Illuminate\Database\Seeder;

class CompraSolicitudEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//
//        CompraSolicitudEstado::truncate();

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
            ['nombre' => 'Autorizada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 5],
            ['nombre' => 'Aprobada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 6],
            ['nombre' => 'Despachada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 7],
            ['nombre' => 'Anulada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 8],
            ['nombre' => 'Cancelada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 9],
            ['nombre' => 'Retorno Solicitada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 10],
            ['nombre' => 'Retorno Autorizada']
        );
        CompraSolicitudEstado::firstOrCreate(
            ['id' => 11],
            ['nombre' => 'Retorno Aprobada']
        );

//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
