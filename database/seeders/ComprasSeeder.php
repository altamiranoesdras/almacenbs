<?php
namespace Database\Seeders;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Stock;
use App\Models\Tienda;
use Illuminate\Database\Seeder;

class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Compra::class,50)->create()
            ->each(function (Compra $compra){
                factory(CompraDetalle::class,random_int(5,25))
                    ->create(['compra_id' => $compra->id])
                    ->each(function (CompraDetalle $detalle){
                        $stock = new Stock();

                        if($detalle->item->inventariable){
                            $stock->egreso($detalle->item_id,$detalle->cantidad,$detalle->id, Tienda::PRINCIPAL);
                        }

                    });
            });
    }
}
