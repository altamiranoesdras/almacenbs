<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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


        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CompraEstadosTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(MagnitudesTableSeeder::class);
        $this->call(UnimedsTableSeeder::class);
        $this->call(SolicitudEstadosTableSeeder::class);
        $this->call(CompraTiposTableSeeder::class);
        $this->call(RenglonesTableSeeder::class);


        $this->call(DivisaSeeder::class);


        if(app()->environment()=='local'){

            $this->call(ItemCategoriaTableSeeder::class);
            $this->call(ItemsTableSeeder::class);

        }
    }
}
