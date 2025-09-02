<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Throwable
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


        $this->call(RrhhUnidadTiposSeeder::class);
        $this->call(RrhhUnidadesTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(UserConfigurationsTableSeeder::class);

        $this->call(RrhhPuestosTableSeeder::class);
        $this->call(UsersTableSeeder::class);

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
        $this->call(EnvioFiscalsTableSeeder::class);
        $this->call(ConsumoEstadosTableSeeder::class);
        $this->call(ItemPresentacionesTableSeeder::class);

        $this->call(ItemCategoriaTableSeeder::class);
        $this->importarInsumos();

        $this->call(CompraSolicitudEstadosTableSeeder::class);


        $this->call(CompraRequisicionEstadosTableSeeder::class);
        $this->call(CompraBandejasTableSeeder::class);

        $this->call(CompraRequisicionProcesoTiposTableSeeder::class);
        $this->call(CompraRequisicionTipoConcursosTableSeeder::class);
        $this->call(CompraRequisicionTipoAdquisicionsTableSeeder::class);




        if(app()->environment()=='local'){

            $this->call(ComprasSeeder::class);
            $this->call(SolicitudesTableSeeder::class);
            $this->call(CompraSolicitudsTableSeeder::class);
            $this->call(CompraRequisicionesTableSeeder::class);
            $this->call(MediaTableSeeder::class);

//            $this->call(ConsumosTableSeeder::class);
////            $this->call(ActivosTableSeeder::class);

        }

        foreach(glob(storage_path('temp/*')) as $file){
            if(is_file($file))
                unlink($file);
        }



    }

    /**
     * @throws \Throwable
     */
    public function importarInsumos(): void
    {
        try {
            $exitCode = Artisan::call('importar:insumos2', [
                '--no-interaction' => true,
            ]);

            $output = Artisan::output();
            dump($output);

            // opcional: si quieres ver el fallo al correr `db:seed`
            if ($exitCode !== 0) {
                throw new \RuntimeException("Comando importar:insumos2 falló con código {$exitCode}. Revisa storage/logs/laravel.log");
            }
        } catch (\Throwable $e) {
            Log::error("[Seeder] Error al ejecutar importar:insumos2: ".$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            // relanza para que el seeding falle visiblemente
            throw $e;
        }

    }
}
