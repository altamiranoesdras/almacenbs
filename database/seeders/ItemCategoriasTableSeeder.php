<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemCategoriasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_categorias')->delete();
        
        \DB::table('item_categorias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'IMPRENTA',
                'descripcion' => NULL,
                'created_at' => '2023-01-26 11:13:30',
                'updated_at' => '2023-01-26 11:13:30',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'LIBRERÍA',
                'descripcion' => NULL,
                'created_at' => '2023-01-27 10:12:08',
                'updated_at' => '2023-01-27 10:12:08',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Varios',
                'descripcion' => NULL,
                'created_at' => '2023-03-17 16:24:37',
                'updated_at' => '2023-03-17 16:24:37',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'REPUESTOS',
                'descripcion' => 'BATERIA',
                'created_at' => '2023-03-21 17:48:45',
                'updated_at' => '2023-03-21 17:48:45',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Cafetería',
                'descripcion' => NULL,
                'created_at' => '2023-10-23 10:41:56',
                'updated_at' => '2023-10-23 10:41:56',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'LIMPIEZA',
                'descripcion' => NULL,
                'created_at' => '2023-10-30 08:36:26',
                'updated_at' => '2023-10-30 08:36:26',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'ACTIVO',
                'descripcion' => NULL,
                'created_at' => '2024-09-25 13:25:14',
                'updated_at' => '2024-09-25 13:25:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}