<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivoTiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activo_tipos')->delete();
        
        \DB::table('activo_tipos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Activo Fijo',
                'created_at' => '2022-08-31 22:56:09',
                'updated_at' => '2022-08-31 22:56:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Bien Fungible',
                'created_at' => '2022-08-31 22:56:17',
                'updated_at' => '2022-08-31 22:56:17',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}