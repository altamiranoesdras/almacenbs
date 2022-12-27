<?php
namespace Database\Seeders;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('compras')->truncate();
        DB::table('stocks')->truncate();
        DB::table('compra_detalles')->truncate();

        Compra::factory()->count(5)
            ->create()
            ->each(function (Compra $compra){
                CompraDetalle::factory()
                    ->count(rand(5,8))
                    ->create([
                        'compra_id' => $compra->id
                    ]);
            });


    }
}
