<?php

namespace Database\Seeders;

use App\Models\Renglon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RenglonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('renglones')->truncate();

        Renglon::factory()->count(10)->create();


    }
}
