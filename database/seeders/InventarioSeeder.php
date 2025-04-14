<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(ActivoTiposTableSeeder::class);
        $this->call(ActivoEstadosTableSeeder::class);

        if(app()->environment()=='local'){

            $this->call(ActivosTableSeeder::class);
            $this->call(ActivoTarjetasTableSeeder::class);

        }




    }
}
