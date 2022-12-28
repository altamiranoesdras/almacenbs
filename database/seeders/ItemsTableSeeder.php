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
use Illuminate\Support\Facades\Artisan;
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




        DB::statement('SET FOREIGN_KEY_CHECKS=0');

//        Artisan::call('import:insumos');

        $this->importarSql();



    }

    public function importarSql()
    {

        $db = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $path = storage_path('insumos.sql');

        $comando = "mysql --user=\"$user\" --password=\"$pass\"  $db < $path";

        exec($comando);

    }

}
