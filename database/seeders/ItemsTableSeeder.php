<?php
namespace Database\Seeders;

use App\Models\ItemCategoria;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Stock;
use App\Models\Unimed;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        /**
         * @var Item $item
         */
        $item = Item::find(1);

        if (app()->environment()=='local'){

            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            DB::table('items')->truncate();
            DB::table('item_has_categoria')->truncate();
            DB::table('stocks')->truncate();
            DB::table('stocks_transacciones')->truncate();
            DB::table('kardexs')->truncate();
            DB::table('compras')->truncate();
            DB::table('compra_detalles')->truncate();

            Item::factory()->count(25)->create();

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }



    }
}
