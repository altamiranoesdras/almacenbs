<?php
namespace Database\Seeders;

use App\Models\Icategoria;
use Illuminate\Database\Seeder;

class IcategoriasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment()=='local'){

            factory(Icategoria::class,5)->create()->each(function (Icategoria $icategoria){

                if (config('app.seed_img')){
                    $icategoria->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('categories');
                }
            });
        }


    }
}
