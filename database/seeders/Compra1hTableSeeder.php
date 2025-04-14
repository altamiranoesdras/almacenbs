<?php

namespace Database\Seeders;

use App\Models\Compra1h;
use App\Models\Compra1hDetalle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Compra1hTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('compra_1h')->truncate();
        DB::table('compra_1h_detalles')->truncate();

        Compra1h::factory()->count(10)
            ->afterCreating(function (Compra1h $compra1h){
                Compra1hDetalle::factory()
                    ->count(rand(5,10))
                    ->create([
                        '1h_id' => $compra1h->id
                    ]);
            })
            ->create();

    }
}
