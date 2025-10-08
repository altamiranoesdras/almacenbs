<?php

namespace Database\Seeders;

use App\Models\RedProduccionProducto;
use App\Models\RedProduccionResultado;
use App\Models\RedProduccionSubProducto;
use Illuminate\Database\Seeder;

class RedProduccionProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        RedProduccionResultado::truncate();
        RedProduccionProducto::truncate();
        RedProduccionSubProducto::truncate();


        RedProduccionResultado::factory(10)
            //con productos
            ->has(
                RedProduccionProducto::factory(3)
                    ->has(RedProduccionSubProducto::factory(3),'subProductos')
                ,'productos')
            ->create();



    }
}
