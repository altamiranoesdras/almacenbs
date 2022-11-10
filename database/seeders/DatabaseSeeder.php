<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if (!file_exists(storage_path('temp'))){
            mkdir(storage_path('temp'));
        }

        foreach(glob(storage_path('app/public/*')) as $file){
            if(file_exists($file)){
                File::deleteDirectory($file);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('media')->truncate();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);

        $this->call(ImportPuestosUnidadesSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(ImportUserSeeder::class);


        $this->call(CompraEstadosTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(MagnitudesTableSeeder::class);
        $this->call(UnimedsTableSeeder::class);
        $this->call(SolicitudEstadosTableSeeder::class);
        $this->call(CompraTiposTableSeeder::class);
        $this->call(RenglonesTableSeeder::class);

        $this->call(ItemsTrasladosEstadosTableSeeder::class);
        $this->call(DivisaSeeder::class);
        $this->call(ItemTiposTableSeeder::class);
        $this->call(ActivoEstadosTableSeeder::class);
        $this->call(ActivoTarjetaEstadosTableSeeder::class);




        if(app()->environment()=='local'){

            $this->call(ItemCategoriaTableSeeder::class);
            $this->call(ItemsTableSeeder::class);

//            $this->call(ComprasSeeder::class);
//            $this->call(SolicitudesTableSeeder::class);
//            $this->call(Compra1hTableSeeder::class);
        }

        Artisan::call("import:colaboradores");


        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach(glob(storage_path('temp/*')) as $file){
            if(is_file($file))
                unlink($file);
        }

    }
}
