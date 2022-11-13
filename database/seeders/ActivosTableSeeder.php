<?php

namespace Database\Seeders;

use App\Models\Activo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('activos')->truncate();


        $db = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $path = storage_path('activos.sql');

        $comando = "mysql --user=\"$user\" --password=\"$pass\"  $db < $path";

        exec($comando);
//        $sql = file_get_contents($path);
//        DB::unprepared($sql);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
