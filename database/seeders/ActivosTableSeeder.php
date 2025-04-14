<?php

namespace Database\Seeders;

use App\Models\Activo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('activos')->truncate();


        Activo::factory()->count(20)->create();


    }
}
