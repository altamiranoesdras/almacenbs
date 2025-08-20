<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //si la aplicación no está corriendo en consola
        if( !app()->runningInConsole() ){
            $configurations = Configuration::pluck('value','key')->toArray();

            foreach ($configurations as $key => $value){
                config([$key => $value]);
            }

        }


        if (app()->runningInConsole()) {
            $platform = DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform();

            $platform->registerDoctrineTypeMapping('enum', 'string');
            $platform->registerDoctrineTypeMapping('set', 'string');      // opcional
            $platform->registerDoctrineTypeMapping('bit', 'boolean');     // opcional
            // $platform->registerDoctrineTypeMapping('json', 'text');    // opcional según tu versión
        }

    }
}
