<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RenglonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('renglones')->delete();
        
        \DB::table('renglones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'numero' => '324',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:21',
                'updated_at' => '2022-11-06 22:17:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'numero' => '329',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:21',
                'updated_at' => '2022-11-06 22:17:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'numero' => '328',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:21',
                'updated_at' => '2022-11-06 22:17:21',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'numero' => '322',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:21',
                'updated_at' => '2022-11-06 22:17:21',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'numero' => '326',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:21',
                'updated_at' => '2022-11-06 22:17:21',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'numero' => '321',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:46',
                'updated_at' => '2022-11-06 22:17:46',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'numero' => '327',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:17:46',
                'updated_at' => '2022-11-06 22:17:46',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'numero' => '323',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:21:44',
                'updated_at' => '2022-11-06 22:21:44',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'numero' => '325',
                'descripcion' => NULL,
                'created_at' => '2022-11-06 22:40:39',
                'updated_at' => '2022-11-06 22:40:39',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}