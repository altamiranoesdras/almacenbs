<?php
namespace Database\Seeders;

use App\Models\Tienda;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $items = \App\Models\Item::all();

        foreach ($items as $index => $item) {

            $stock = $item->stock;
            $stock = 1000;

            $tienda= array_random([Tienda::LOCAL_1, Tienda::LOCAL_2]);

            if($item->materia_prima){
                factory(\App\Models\Stock::class,1)->create([
                    'item_id' => $item->id,
                    'cantidad' => $stock,
                    'cantidad_inicial' => $stock,
                ]);
                factory(\App\Models\Stock::class,1)->create([
                    'item_id' => $item->id,
                    'cantidad' => $stock,
                    'cantidad_inicial' => $stock,
                ]);
            }else{
                factory(\App\Models\Stock::class,1)->create([
                    'item_id' => $item->id,
                    'cantidad' => $stock,
                    'cantidad_inicial' => $stock,
                ]);
                factory(\App\Models\Stock::class,1)->create([
                    'item_id' => $item->id,
                    'cantidad' => $stock,
                    'cantidad_inicial' => $stock,
                ]);
                factory(\App\Models\Stock::class,1)->create([
                    'item_id' => $item->id,
                    'cantidad' => $stock,
                    'cantidad_inicial' => $stock,
                ]);
            }


//            factory(\App\Models\Stock::class,1)->create(['item_id' => $item->id,'cantidad' => $stock2,'cantidad_inicial' => $stock2]);
            factory(\App\Models\Inistock::class,1)->create(['item_id' => $item->id,'cantidad' => $stock]);
        }


    }
}
