<?php

namespace Database\Seeders;

use App\Models\RrhhUnidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RrhhUnidadesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('rrhh_unidades')->delete();

        RrhhUnidad::factory()->count(10)->create();

    }
}
