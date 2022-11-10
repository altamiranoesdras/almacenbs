<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivoEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('activo_estados')->truncate();

        \DB::table('activo_estados')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'EN TRASLADO',
                'created_at' => '2022-11-06 22:29:42',
                'updated_at' => '2022-11-06 22:29:42',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'ALMACENADO',
                'created_at' => '2022-11-06 22:29:42',
                'updated_at' => '2022-11-06 22:29:42',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'RESGUARDADO',
                'created_at' => '2022-11-06 22:29:42',
                'updated_at' => '2022-11-06 22:29:42',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'SOLICITADO BAJA',
                'created_at' => '2022-11-06 22:29:43',
                'updated_at' => '2022-11-06 22:29:43',
                'deleted_at' => NULL,
            ),
        ));


    }
}
