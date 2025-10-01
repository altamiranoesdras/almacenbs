<?php

namespace Database\Seeders;

use App\Models\ItemCategoria;
use Illuminate\Database\Seeder;

class ItemCategoriasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        ItemCategoria::truncate();

        ItemCategoria::firstOrCreate(['nombre' => 'ALIMENTOS']);
        ItemCategoria::firstOrCreate(['nombre' => 'FARMACIA']);
        ItemCategoria::firstOrCreate(['nombre' => 'FERRETERÍA']);
        ItemCategoria::firstOrCreate(['nombre' => 'LIBRERÍA']);
        ItemCategoria::firstOrCreate(['nombre' => 'LIMPIEZA']);
        ItemCategoria::firstOrCreate(['nombre' => 'MOBILIARIO Y EQUIPO']);
        ItemCategoria::firstOrCreate(['nombre' => 'ROPERÍA Y VARIOS']);

    }
}
