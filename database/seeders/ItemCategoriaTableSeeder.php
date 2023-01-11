<?php
namespace Database\Seeders;

use App\Models\ItemCategoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemCategoriaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment()=='local'){

            DB::table('item_categorias')->truncate();

            if (app()->environment()=="local"){

                ItemCategoria::factory()->count(5)->create()->each(function (ItemCategoria $icategoria){

                    if (config('app.seed_img')){
                        $icategoria->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('categories');
                    }
                });
            }
        }


    }
}
