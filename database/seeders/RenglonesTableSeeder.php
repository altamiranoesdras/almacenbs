<?php

namespace Database\Seeders;

use App\Models\Renglon;
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

        Renglon::factory()->count(10)->create();

    }
}
