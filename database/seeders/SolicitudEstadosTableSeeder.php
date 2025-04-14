<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('solicitud_estados')->delete();

        \DB::table('solicitud_estados')->insert(array (
            0 =>
            array (
                'created_at' => '2022-08-01 12:26:47',
                'deleted_at' => NULL,
                'id' => 1,
                'nombre' => 'Temporal',
                'updated_at' => '2022-08-01 12:26:48',
            ),
            1 =>
            array (
                'created_at' => '2022-08-02 16:57:24',
                'deleted_at' => NULL,
                'id' => 2,
                'nombre' => 'Ingresada',
                'updated_at' => '2022-08-02 16:57:24',
            ),
            2 =>
            array (
                'created_at' => '2018-07-31 14:46:09',
                'deleted_at' => NULL,
                'id' => 3,
                'nombre' => 'Solicitada',
                'updated_at' => '2018-07-31 14:46:09',
            ),
            3 =>
            array (
                'created_at' => '2022-08-05 11:10:59',
                'deleted_at' => NULL,
                'id' => 4,
                'nombre' => 'Autorizada',
                'updated_at' => '2022-08-05 11:11:00',
            ),
            4 =>
            array (
                'created_at' => '2018-07-31 14:46:16',
                'deleted_at' => NULL,
                'id' => 5,
                'nombre' => 'Aprobada',
                'updated_at' => '2018-07-31 14:46:16',
            ),
            5 =>
            array (
                'created_at' => '2018-07-31 14:46:23',
                'deleted_at' => NULL,
                'id' => 6,
                'nombre' => 'Despachada',
                'updated_at' => '2018-07-31 14:46:23',
            ),
            6 =>
            array (
                'created_at' => '2018-07-31 14:46:30',
                'deleted_at' => NULL,
                'id' => 7,
                'nombre' => 'Anulada',
                'updated_at' => '2018-07-31 14:46:30',
            ),
            7 =>
            array (
                'created_at' => '2018-07-31 14:46:43',
                'deleted_at' => NULL,
                'id' => 8,
                'nombre' => 'Cancelada',
                'updated_at' => '2018-07-31 14:46:43',
            ),
            8 =>
            array (
                'created_at' => '2023-04-26 08:48:50',
                'deleted_at' => NULL,
                'id' => 9,
                'nombre' => 'RETORNO Solicitada',
                'updated_at' => '2023-04-26 08:49:30',
            ),
            9 =>
            array (
                'created_at' => '2023-04-26 08:49:03',
                'deleted_at' => NULL,
                'id' => 10,
                'nombre' => 'RETORNO Autorizada',
                'updated_at' => '2023-04-26 08:49:03',
            ),
            10 =>
            array (
                'created_at' => '2023-04-26 08:49:18',
                'deleted_at' => NULL,
                'id' => 11,
                'nombre' => 'RETORNO APROBADA',
                'updated_at' => '2023-04-26 08:49:18',
            ),
        ));



    }
}
