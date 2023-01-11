<?php

namespace Database\Seeders;

use App\Models\Proveedor;
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


        \DB::table('proveedores')->truncate();

        \DB::table('proveedores')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nit' => '2713572-1',
                'nombre' => 'MARTINEZ LIC, LUIS FRANCISCO',
                'razon_social' => 'MARTINEZ LIC, LUIS FRANCISCO',
                'correo' => 'lflic7@gmail.com',
                'telefono_movil' => '5433-361',
                'telefono_oficina' => '2441-715',
            'direccion' => 'Diagonal 20 (Av. Miraflores) 6-98 Z. 11, Guatemala',
                'observaciones' => 'Estanterías de metal',
                'created_at' => '2022-12-28 08:35:40',
                'updated_at' => '2023-01-09 12:36:49',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nit' => '3237591-3',
                'nombre' => 'NUEVOS ALMACENES, SOCIEDAD ANONIMA',
                'razon_social' => 'NUEVOS ALMACENES, SOCIEDAD ANONIMA',
                'correo' => 'servicioempresas@cemaco.com',
                'telefono_movil' => NULL,
                'telefono_oficina' => '24997575',
                'direccion' => NULL,
                'observaciones' => 'CEMACO',
                'created_at' => '2023-01-04 08:40:14',
                'updated_at' => '2023-01-04 08:40:14',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nit' => '2519388-0',
                'nombre' => 'TECNOSOLUCIONES, SOCIEDAD ANONIMA',
                'razon_social' => 'TECNOSOLUCIONES, SOCIEDAD ANONIMA',
                'correo' => 'lquinonez@tecnosoluciones.com.gt',
                'telefono_movil' => '4270-733',
                'telefono_oficina' => '2285-962',
                'direccion' => '4ta. Calle 0-74 Zona 13, Pamplona, Guatemala',
                'observaciones' => 'Equipo de Computación',
                'created_at' => '2023-01-06 10:44:06',
                'updated_at' => '2023-01-09 12:36:21',
                'deleted_at' => NULL,
            ),
        ));


    }
}
