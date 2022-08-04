<?php

namespace Database\Seeders;

use App\Models\RrhhPuesto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RrhhPuestosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('rrhh_puestos')->delete();

        RrhhPuesto::factory()->count(10)->create();
    }
}
