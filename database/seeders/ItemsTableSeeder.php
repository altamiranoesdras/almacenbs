<?php
namespace Database\Seeders;

use App\Models\ItemCategoria;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Stock;
use App\Models\Unimed;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {



        if (app()->environment()=='local'){

            \DB::statement('SET FOREIGN_KEY_CHECKS=0');

            \DB::table('items')->truncate();
            \DB::table('item_has_categoria')->truncate();


            Item::factory()->count(5)->create()
                ->each(function (Item $item) {

//                    $stock = rand(20,40);
//
//                    factory(Stock::class,1)->create([
//                        'item_id' => $item->id,
//                        'cantidad' => $stock,
//                        'cnt_ini' => $stock,
//                    ])->each(function (Stock $stock){
//                        $stock->kardex()->create([
//                            'item_id' => $stock->item_id,
//                            'cantidad' => $stock->cantidad,
//                            'tipo' => Kardex::TIPO_INGRESO,
//                            'user_id' => 1,
//                            'codigo' => $stock->id,
//                            'responsable' => 'Stock Inicial'
//                        ]);
//
//                    });

//                    $item->categorias()->attach(ItemCategoria::pluck('id')->random(4));
//
//
//                    if (config('app.seed_img')){
//
//                        $item->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('items');
//                        $item->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('items');
//                    }



                });

            \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }



    }
}
