<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

const PANEL_DE_CONTROL =        1;
const NUEVA_COMPRA =            4;
const PROVEEDORES =             5;
const BUSCAR_COMPRAS =          6;
const NUEVA_REQUISICION =       8;
const MIS_REQUISICIONES =       9;
const DESPACHAR_REQUISICION =   10;
const BUSCAR_REQUISICION =      11;
const NUEVO_ARTICULO =          14;
const BUSCAR_ARTÍCULO =         15;
const CATEGORIAS =              16;
const UNIDADES_DE_MEDIDA =      17;
const MARCAS =                  18;
const MAGNITUDES =              19;
const IMPORTAR_EXCEL =          20;
const TRASLADO_ENTRE_UNIDADES = 21;
const STOCK =                   24;
const KARDEX =                  25;
const ARTICULOS_A_VENCER =      26;
const USUARIOS =                28;
const ROLES =                   29;
const PERMISOS =                30;
const CONFIGURACIONES =         31;
const AUTORIZAR_REQUISICION =   32;
const APROBAR_REQISICION =      33;

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
            "username" => "jefe_almacen",
            "name" => "Jefe Almacen",
            "password" => bcrypt("123456")
        ])->each(function (User $user){

            $user->syncRoles(Role::JEFE_ALMACEN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                PANEL_DE_CONTROL,
                NUEVA_COMPRA,
                PROVEEDORES,
                BUSCAR_COMPRAS,
                BUSCAR_REQUISICION,
                NUEVA_REQUISICION,
                DESPACHAR_REQUISICION,
                NUEVO_ARTICULO,
                BUSCAR_ARTÍCULO,
                TRASLADO_ENTRE_UNIDADES,
                STOCK,
                KARDEX,
                ARTICULOS_A_VENCER,
                USUARIOS,
                ROLES,
                PERMISOS,
                CONFIGURACIONES,
            ]);

        });



    }
}
