<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConsumoEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('consumo_estados')->delete();
        
        \DB::table('consumo_estados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'TEMPORAL',
                'created_at' => '2022-12-27 11:06:48',
                'updated_at' => '2022-12-27 11:06:48',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'INGRESADO',
                'created_at' => '2022-12-27 11:07:00',
                'updated_at' => '2022-12-27 11:07:15',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'PROCESADO',
                'created_at' => '2022-12-27 11:07:22',
                'updated_at' => '2022-12-27 11:07:22',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'ANULADO',
                'created_at' => '2022-12-27 11:07:32',
                'updated_at' => '2022-12-27 11:07:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}