<?php
namespace Database\Seeders;

use App\Models\Divisa;
use Illuminate\Database\Seeder;

class DivisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Divisa::class,1)->create(['simbolo' => 'Q','nombre' => 'Quetzal GTM']);
        factory(Divisa::class,1)->create(['simbolo' => '$','nombre' => 'Dolar USD']);
    }
}
