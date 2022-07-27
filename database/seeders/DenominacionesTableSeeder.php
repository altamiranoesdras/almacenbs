<?php
namespace Database\Seeders;

use App\Models\Denominacione;
use Illuminate\Database\Seeder;

class DenominacionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        factory(Denominacione::class,1)->create(['monto'=> 200]);
        factory(Denominacione::class,1)->create(['monto'=> 100]);
        factory(Denominacione::class,1)->create(['monto'=> 50]);
        factory(Denominacione::class,1)->create(['monto'=> 20]);
        factory(Denominacione::class,1)->create(['monto'=> 10]);
        factory(Denominacione::class,1)->create(['monto'=> 5]);
        factory(Denominacione::class,1)->create(['monto'=> 1]);
        factory(Denominacione::class,1)->create(['monto'=> .5]);
        factory(Denominacione::class,1)->create(['monto'=> .25]);

    }
}
