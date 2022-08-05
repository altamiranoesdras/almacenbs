<?php

namespace Database\Seeders;

use App\Models\ItemTipo;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('item_tipos')->truncate();

        ItemTipo::factory()->count(1)->create(['nombre' => "ACTIVO FIJO"]);
        ItemTipo::factory()->count(1)->create(['nombre' => "FUNGIBLE"]);
        ItemTipo::factory()->count(1)->create(['nombre' => "MATERIALES Y SUMINISTROS"]);
        ItemTipo::factory()->count(1)->create(['nombre' => "SERVICIOS"]);

    }
}
