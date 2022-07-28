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
        Divisa::factory()->count(1)->create(['simbolo' => 'Q','nombre' => 'Quetzal GTM']);
    }
}
