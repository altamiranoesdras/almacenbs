<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivoEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('activo_estados')->truncate();

        DB::table('activo_estados')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'BUEN ESTADO',
                'created_at' => '2022-08-31 23:02:39',
                'updated_at' => '2022-08-31 23:02:39',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'REGULAR',
                'created_at' => '2022-08-31 23:02:46',
                'updated_at' => '2022-08-31 23:02:46',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'MAL ESTADO U OBSOLETO',
                'created_at' => '2022-08-31 23:02:59',
                'updated_at' => '2022-08-31 23:02:59',
                'deleted_at' => NULL,
            ),
        ));


    }
}
