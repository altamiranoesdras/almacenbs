<?php

namespace Database\Seeders;

use App\Models\Activo;
use Illuminate\Database\Seeder;

class ActivosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('activos')->delete();


        Activo::factory()->count(50)->create();



    }
}
