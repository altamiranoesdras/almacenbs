<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('options')->delete();

        \DB::table('options')->insert(array (
            0 =>
            array (
                'id' => 1,
                'option_id' => NULL,
                'nombre' => 'Dashboard',
                'ruta' => 'admin.dashboard',
                'descripcion' => NULL,
                'icono_l' => 'fa-chart-line',
                'icono_r' => NULL,
                'orden' => 0,
                'color' => 'bg-primary',
                'recursos' => 0,
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'option_id' => NULL,
                'nombre' => 'Admin',
                'ruta' => '',
                'descripcion' => NULL,
                'icono_l' => 'fa-tools',
                'icono_r' => NULL,
                'orden' => 1,
                'color' => 'bg-secondary',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'option_id' => 2,
                'nombre' => 'Usuarios',
                'ruta' => 'users.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-users',
                'icono_r' => NULL,
                'orden' => 2,
                'color' => 'bg-success',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'option_id' => 2,
                'nombre' => 'Roles',
                'ruta' => 'roles.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-user-tag',
                'icono_r' => NULL,
                'orden' => 3,
                'color' => 'bg-info',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'option_id' => 2,
                'nombre' => 'Permisos',
                'ruta' => 'permissions.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-key',
                'icono_r' => NULL,
                'orden' => 4,
                'color' => 'bg-warning',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'option_id' => 2,
                'nombre' => 'Configuraciones',
                'ruta' => 'profile.business',
                'descripcion' => NULL,
                'icono_l' => 'fa-cogs',
                'icono_r' => NULL,
                'orden' => 5,
                'color' => 'bg-success',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2021-03-14 21:17:37',
                'updated_at' => '2022-10-12 16:37:13',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'option_id' => NULL,
                'nombre' => 'Developer',
                'ruta' => '',
                'descripcion' => NULL,
                'icono_l' => 'fa-file-code',
                'icono_r' => NULL,
                'orden' => 6,
                'color' => 'bg-warning',
                'recursos' => 1,
                'dev' => 1,
                'created_at' => '2021-03-14 21:11:34',
                'updated_at' => '2022-10-12 16:37:07',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'option_id' => 7,
                'nombre' => 'Prueba API\'S',
                'ruta' => 'dev.prueba.api',
                'descripcion' => NULL,
                'icono_l' => 'fa-check-circle',
                'icono_r' => NULL,
                'orden' => 9,
                'color' => 'bg-primary',
                'recursos' => 0,
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:07',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'option_id' => 7,
                'nombre' => 'Configuraciones',
                'ruta' => 'configurations.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-cogs',
                'icono_r' => NULL,
                'orden' => 8,
                'color' => 'bg-success',
                'recursos' => 1,
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:07',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 11,
                'option_id' => 7,
                'nombre' => 'Menu',
                'ruta' => 'options.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-list',
                'icono_r' => NULL,
                'orden' => 7,
                'color' => 'bg-success',
                'recursos' => 1,
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2022-10-12 16:37:07',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 12,
                'option_id' => 7,
                'nombre' => 'Pruebas',
                'ruta' => 'dev.pruebas.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-circle-notch',
                'icono_r' => NULL,
                'orden' => 0,
                'color' => 'bg-danger',
                'recursos' => 1,
                'dev' => 0,
                'created_at' => '2022-10-22 19:42:05',
                'updated_at' => '2022-10-22 19:42:05',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 13,
                'option_id' => 7,
                'nombre' => 'Logs',
                'ruta' => 'dev.logs',
                'descripcion' => NULL,
                'icono_l' => 'fa-list',
                'icono_r' => NULL,
                'orden' => 0,
                'color' => 'bg-danger',
                'recursos' => 0,
                'dev' => 1,
                'created_at' => '2022-11-02 23:47:22',
                'updated_at' => '2022-11-02 23:47:22',
                'deleted_at' => NULL,
            ),
        ));

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
