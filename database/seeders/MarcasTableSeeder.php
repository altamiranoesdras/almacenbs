<?php
namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        if (app()->environment()=='local'){


            DB::table('marcas')->truncate();

            Marca::factory()->count(5)->create()->each(function (Marca $marca){

                if (config('app.seed_img')){
                    $marca->addMediaFromUrl("https://picsum.photos/600/400")->toMediaCollection('marcas');
                }
            });

        }




    }
}
