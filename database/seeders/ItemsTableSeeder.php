<?php
namespace Database\Seeders;

use App\Models\Icategoria;
use App\Models\Inistock;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Stock;
use App\Models\Tienda;
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
            \DB::table('icategoria_item')->truncate();

            factory(Item::class,25)->create()
                ->each(function (Item $item) {

                    $stock = rand(20,40);

                    factory(Stock::class,1)->create([
                        'item_id' => $item->id,
                        'cantidad' => $stock,
                        'cnt_ini' => $stock,
                        'tienda_id'=> Tienda::PRINCIPAL
                    ])->each(function (Stock $stock){
                        $stock->kardex()->create([
                            'tienda_id'=> $stock->tienda_id,
                            'item_id' => $stock->item_id,
                            'cantidad' => $stock->cantidad,
                            'tipo' => Kardex::TIPO_INGRESO,
                            'user_id' => 1,
                            'codigo' => $stock->id,
                            'responsable' => 'Stock Inicial'
                        ]);

                    });

                    factory(Stock::class,1)->create([
                        'item_id' => $item->id,
                        'cantidad' => $stock*2,
                        'cnt_ini' => $stock,
                        'tienda_id'=> Tienda::SUCURSAL_1
                    ])->each(function (Stock $stock){

                        $stock->kardex()->create([
                            'tienda_id'=> $stock->tienda_id,
                            'item_id' => $stock->item_id,
                            'cantidad' => $stock->cantidad,
                            'tipo' => Kardex::TIPO_INGRESO,
                            'user_id' => 1,
                            'codigo' => $stock->id,
                            'responsable' => 'Stock Inicial'
                        ]);
                    });


                    factory(Stock::class,1)->create([
                        'item_id' => $item->id,
                        'cantidad' => $stock*3,
                        'cnt_ini' => $stock,
                        'tienda_id'=> Tienda::SUCURSAL_2
                    ])->each(function (Stock $stock){

                        $stock->kardex()->create([
                            'tienda_id'=> $stock->tienda_id,
                            'item_id' => $stock->item_id,
                            'cantidad' => $stock->cantidad,
                            'tipo' => Kardex::TIPO_INGRESO,
                            'user_id' => 1,
                            'codigo' => $stock->id,
                            'responsable' => 'Stock Inicial'
                        ]);
                    });

                    $item->categorias()->attach(Icategoria::pluck('id')->random(4));


                    if (config('app.seed_img')){

                        $item->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('items');
                        $item->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('items');
                    }



                });

            \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }



    }
}
