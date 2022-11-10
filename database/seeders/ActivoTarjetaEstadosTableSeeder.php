<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivoTarjetaEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activo_tarjeta_estados')->delete();
        
        \DB::table('activo_tarjeta_estados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'TEMPORAL',
                'created_at' => '2022-11-10 17:00:06',
                'updated_at' => '2022-11-10 17:00:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'CREADA',
                'created_at' => '2022-11-10 17:00:14',
                'updated_at' => '2022-11-10 17:00:15',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}