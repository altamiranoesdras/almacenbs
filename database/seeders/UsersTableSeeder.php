<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        //Usuario admin
        User::factory(1)->create([
            "username" => "dev",
            "name" => "Developer",
            "password" => bcrypt("admin")
        ])->each(function (User $user){
            $user->syncRoles([Role::DEVELOPER]);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([3,4,5,6]);
        });

        User::factory(1)->create([
            "username" => "Super",
            "name" => "Super Admin",
            "password" => bcrypt("123456")
        ])->each(function (User $user){
            $user->syncRoles(Role::SUPERADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([3,4,5,6]);

        });

        User::factory(1)->create([
            "username" => "Admin",
            "name" => "Administrador",
            "password" => bcrypt("123456")
        ])->each(function (User $user){
            $user->syncRoles(Role::ADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([3,4,5,6]);

        });


        User::factory(1)->create([
            "username" => "mnavichoque",
            "name" => "Madelin Gabriela Navichoque Carranza",
            "password" => bcrypt("123456")
        ])->each(function (User $user){

            $user->syncRoles(Role::JEFE_ALMACEN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::PANEL_DE_CONTROL,
                Option::NUEVA_COMPRA,
                Option::PROVEEDORES,
                Option::BUSCAR_COMPRAS,
                Option::BUSCAR_REQUISICION,
                Option::NUEVA_REQUISICION,
                Option::DESPACHAR_REQUISICION,
                Option::NUEVO_ARTICULO,
                Option::BUSCAR_ARTÍCULO,
                Option::TRASLADO_ENTRE_UNIDADES,
                Option::STOCK,
                Option::KARDEX,
                Option::ARTICULOS_A_VENCER,
                Option::USUARIOS,
                Option::ROLES,
                Option::PERMISOS,
                Option::CONFIGURACIONES,
            ]);

        });



    }
}
