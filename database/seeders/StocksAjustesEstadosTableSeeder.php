<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StocksAjustesEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('stocks_ajustes_estados')->truncate();

        \DB::table('stocks_ajustes_estados')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'INGRESANADO',
                'created_at' => '2021-05-20 12:31:15',
                'updated_at' => '2021-05-20 12:31:15',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'PROCESADO',
                'created_at' => '2021-05-20 12:34:13',
                'updated_at' => '2021-05-20 12:34:13',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'CANCELADO',
                'created_at' => '2021-05-20 12:35:01',
                'updated_at' => '2021-05-20 12:35:01',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'ANULADO',
                'created_at' => '2021-05-20 12:35:09',
                'updated_at' => '2021-05-20 12:35:09',
                'deleted_at' => NULL,
            ),
        ));

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
