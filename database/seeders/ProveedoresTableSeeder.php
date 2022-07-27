<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ProveedoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('proveedores')->delete();


        factory(\App\Models\Proveedor::class,1)->create([
            'nit' => '00000',
            'nombre' => 'TRASLADOS Y OTROS',
            'razon_social' => 'TRASLADOS Y OTROS',
            'correo' => '',
        ]);

        if(App::environment()=='local'){
            factory(\App\Models\Proveedor::class,1)->create([
                'nit' => '00000',
                'nombre' => 'Proveedor de prueba 2',
                'razon_social' => 'Proveedor de prueba 2 S.A',
                'correo' => '',
            ]);

            factory(\App\Models\Proveedor::class,1)->create([
                'nit' => '00000',
                'nombre' => 'Proveedor de prueba 3',
                'razon_social' => 'Proveedor de prueba 3 S.A',
                'correo' => '',
            ]);
        }


    }
}
