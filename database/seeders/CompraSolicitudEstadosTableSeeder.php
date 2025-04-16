<?php

namespace Database\Seeders;

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


        \DB::table('compra_solicitud_estados')->delete();

        \DB::table('compra_solicitud_estados')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'TEMPORAL',
                'created_at' => '2025-04-15 10:09:52',
                'updated_at' => '2025-04-15 10:09:52',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'TEMPORAL',
                'created_at' => '2025-04-15 10:09:58',
                'updated_at' => '2025-04-15 10:09:58',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'PROCESADA',
                'created_at' => '2025-04-15 10:10:05',
                'updated_at' => '2025-04-15 10:10:05',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'RESERVADA',
                'created_at' => '2025-04-15 10:10:12',
                'updated_at' => '2025-04-15 10:10:12',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'nombre' => 'ANULADA',
                'created_at' => '2025-04-15 10:10:12',
                'updated_at' => '2025-04-15 10:10:12',
                'deleted_at' => NULL,
            ),
        ));


    }
}
