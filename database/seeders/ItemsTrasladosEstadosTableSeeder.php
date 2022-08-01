<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemsTrasladosEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('items_traslados_estados')->delete();


        \DB::table('items_traslados_estados')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'nombre' => 'PROCESADO',
                    'created_at' => '2021-05-13 11:49:03',
                    'updated_at' => '2021-05-13 11:49:03',
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'nombre' => 'ANULADO',
                    'created_at' => '2021-05-13 11:49:09',
                    'updated_at' => '2021-05-13 11:49:09',
                    'deleted_at' => NULL,
                ),
        ));
    }
}
