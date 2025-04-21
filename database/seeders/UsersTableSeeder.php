<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
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


        deshabilitaLlavesForaneas();

        DB::table('users')->truncate();

        //Usuario admin
        User::factory(1)->create([
            "username" => "dev",
            "name" => "Developer",
            "password" => bcrypt("123456"),
            'bodega_id' => 1,
            'unidad_id' => 1,
            'puesto_id' => 1,
        ])->each(function (User $user){
            $user->syncRoles([Role::DEVELOPER]);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::USUARIOS,
                Option::ROLES,
                Option::PERMISOS,
                Option::CONFIGURACIONES,
            ]);
        });

        User::factory(1)->create([
            "username" => "Super",
            "name" => "Super Admin",
            "password" => bcrypt("123456"),
            'bodega_id' => 1,
            'unidad_id' => 1,
            'puesto_id' => 1,
        ])->each(function (User $user){
            $user->syncRoles(Role::SUPERADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::USUARIOS,
                Option::ROLES,
                Option::PERMISOS,
                Option::CONFIGURACIONES,
            ]);
        });

        User::factory(1)->create([
            "username" => "Admin",
            "name" => "Administrador",
            "password" => bcrypt("123456"),
            'bodega_id' => 1,
            'unidad_id' => 1,
            'puesto_id' => 1,
        ])->each(function (User $user){
            $user->syncRoles(Role::ADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::USUARIOS,
                Option::ROLES,
                Option::PERMISOS,
                Option::CONFIGURACIONES,
            ]);

        });





        User::factory(1)->create([
            "username" => "tecnico",
            "name" => "Juan Pérez",
            "password" => bcrypt("123456"),
            'unidad_id' => 1,
            'bodega_id' => 1,
            'puesto_id' => 1,
        ])->each(function (User $user){

            $user->syncRoles(Role::JEFE_ALMACEN);

            $user->options()->sync([
                Option::PANEL_DE_CONTROL,
                Option::NUEVA_COMPRA_SOLA,
//                Option::NUEVA_COMPRA,
                Option::PROVEEDORES,
                Option::BUSCAR_COMPRAS,
                Option::BUSCAR_REQUISICION,
                Option::NUEVA_REQUISICION,
                Option::DESPACHAR_REQUISICION,
                Option::NUEVO_ARTICULO,
                Option::BUSCAR_ARTÍCULO,
                Option::IMPORTAR_EXCEL,
                Option::MARCAS,
                Option::CATEGORIAS,
                Option::UNIDADES_DE_MEDIDA,
                Option::MAGNITUDES,
                Option::TRASLADO_ENTRE_UNIDADES,
                Option::STOCK,
                Option::KARDEX,
                Option::ARTICULOS_A_VENCER,
            ]);

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
            ]);

        });


    }
}
