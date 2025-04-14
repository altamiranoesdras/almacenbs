<?php
namespace Database\Seeders;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Kardex;
use App\Models\Stock;
use App\Models\StockTransaccion;
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

        Compra::truncate();
        CompraDetalle::truncate();
        Stock::truncate();
        StockTransaccion::truncate();
        Kardex::truncate();

        Compra::factory()->count(20)
            ->create()
            ->each(function (Compra $compra){
                CompraDetalle::factory()
                    ->count(rand(5,10))
                    ->create([
                        'compra_id' => $compra->id
                    ]);

                $compra->procesarKardex();
            });


    }
}
