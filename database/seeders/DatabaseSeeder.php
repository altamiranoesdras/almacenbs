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

        deshabilitaLlavesForaneas();

        if (!file_exists(storage_path('temp'))){
            mkdir(storage_path('temp'));
        }

        foreach(glob(storage_path('app/public/*')) as $file){
            if(file_exists($file)){
                File::deleteDirectory($file);
            }
        }


        DB::table('media')->truncate();

        $this->call(RrhhUnidadesTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);

//        $this->call(ImportPuestosUnidadesSeeder::class);
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
        $this->call(ActivoTiposTableSeeder::class);
        $this->call(ActivoSolicitudEstadoTableSeeder::class);
        $this->call(ActivoSolicitudTiposTableSeeder::class);
        $this->call(EnvioFiscalSeeder::class);
        $this->call(ConsumoEstadosTableSeeder::class);
        $this->call(ItemPresentacionesTableSeeder::class);

        $this->call(ItemCategoriaTableSeeder::class);
        $this->call(ItemsTableSeeder::class);

//        Artisan::call("import:colaboradores");

        $this->call(CompraSolicitudEstadosTableSeeder::class);


        if(app()->environment()=='local'){

//            $this->call(ComprasSeeder::class);
//            $this->call(SolicitudesTableSeeder::class);
//            $this->call(ConsumosTableSeeder::class);
//            $this->call(Compra1hTableSeeder::class);
//            $this->call(ActivosTableSeeder::class);

        }

        foreach(glob(storage_path('temp/*')) as $file){
            if(is_file($file))
                unlink($file);
        }

        habilitaLlavesForaneas();

    }
}
