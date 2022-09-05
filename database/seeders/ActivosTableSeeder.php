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


        DB::table('activos')->truncate();


        Activo::factory()->count(10)->create();



    }
}
