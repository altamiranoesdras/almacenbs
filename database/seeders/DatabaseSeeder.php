<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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


        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);

        $this->call(ImportPuestosUnidadesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ImportUserSeeder::class);


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



        if(app()->environment()=='local'){

            $this->call(ItemCategoriaTableSeeder::class);
            $this->call(ItemsTableSeeder::class);
            $this->call(ComprasSeeder::class);

            $this->call(SolicitudesTableSeeder::class);
    }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach(glob(storage_path('temp/*')) as $file){
            if(is_file($file))
                unlink($file);
        }

    }
}
