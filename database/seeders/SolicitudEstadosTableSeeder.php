<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SolicitudEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('solicitud_estados')->delete();
        
        \DB::table('solicitud_estados')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Temporal',
                'created_at' => '2022-08-01 12:26:47',
                'updated_at' => '2022-08-01 12:26:48',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Ingresada',
                'created_at' => '2022-08-02 16:57:24',
                'updated_at' => '2022-08-02 16:57:24',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Solicitada',
                'created_at' => '2018-07-31 14:46:09',
                'updated_at' => '2018-07-31 14:46:09',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Autorizada',
                'created_at' => '2022-08-05 11:10:59',
                'updated_at' => '2022-08-05 11:11:00',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Aprobada',
                'created_at' => '2018-07-31 14:46:16',
                'updated_at' => '2018-07-31 14:46:16',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Despachada',
                'created_at' => '2018-07-31 14:46:23',
                'updated_at' => '2018-07-31 14:46:23',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Anulada',
                'created_at' => '2018-07-31 14:46:30',
                'updated_at' => '2018-07-31 14:46:30',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'Cancelada',
                'created_at' => '2018-07-31 14:46:43',
                'updated_at' => '2018-07-31 14:46:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}