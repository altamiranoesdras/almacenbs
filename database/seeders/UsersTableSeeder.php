<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Option;
use App\Models\Role;
use App\Models\RrhhPuesto;
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
                Option::MIS_REQUISICIONES,
                Option::NUEVA_COMPRA,
                Option::BUSCAR_COMPRAS,
                Option::BUSCAR_ARTÍCULO,
                Option::NUEVO_ARTICULO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION,
                Option::USUARIOS,
                Option::ROLES,
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
                Option::MIS_REQUISICIONES,
                Option::NUEVA_COMPRA,
                Option::BUSCAR_COMPRAS,
                Option::BUSCAR_ARTÍCULO,
                Option::NUEVO_ARTICULO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION,
                Option::USUARIOS,
                Option::ROLES,
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
                Option::MIS_REQUISICIONES,
                Option::NUEVA_COMPRA,
                Option::BUSCAR_COMPRAS,
                Option::BUSCAR_ARTÍCULO,
                Option::NUEVO_ARTICULO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION,
                Option::USUARIOS,
                Option::ROLES,
                Option::CONFIGURACIONES,
            ]);

        });

        $usuarios = [
            [
                'username' => 'nora.castillo',
                'name' => 'NORA SUCELY CASTILLO LÓPEZ',
                'email' => 'jefatura.almace@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::JEFE_DEPARTAMENTO_ALMACEN,
            ],
            [
                'username' => 'elena.lucas',
                'name' => 'ELENA JUAN LUCAS',
                'email' => 'elena.lucas@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
            ],
            [
                'username' => 'antonio.rodriguez',
                'name' => 'ANTONIO RODRÍGUEZ',
                'email' => 'operativos.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::AUXILIAR_DE_BODEGA,
            ],
            [
                'username' => 'lilian.valle',
                'name' => 'LILIAN MARBETTI VALLE ORDÓÑEZ',
                'email' => 'almacen.asistente@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ANALISTA_ALMACEN,
            ],
            [
                'username' => 'martha.ramos',
                'name' => 'MARTHA YESENIA RAMOS FUENTES',
                'email' => 'recepcion.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::RECEPCIONISTA,
            ],
            [
                'username' => 'mynor.medina',
                'name' => 'MYNOR MANUEL MEDINA GODÍNEZ',
                'email' => 'mynor.medina@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
            ],
            [
                'username' => 'cesar.vicente',
                'name' => 'CÉSAR AUGUSTO VICENTE RODRÍGUEZ',
                'email' => 'cesar.vicente@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
            ],
            [
                'username' => 'roberto.tiul',
                'name' => 'ROBERTO TIUL ICHICH',
                'email' => 'operativos2.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::AUXILIAR_DE_BODEGA,
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::factory(1)->create([
                'username' => $usuario['username'],
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'password' => bcrypt('123456'),
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => 1,
                'puesto_id' => $usuario['puesto_id'],
            ])->each(function (User $user) {
                $user->syncRoles(Role::find(2)); // Asigna un rol predeterminado (ajustar según tus roles)
                $user->options()->sync(Option::pluck('id')->toArray());
                $user->shortcuts()->sync([
                    Option::MIS_REQUISICIONES,
                    Option::NUEVA_COMPRA,
                    Option::BUSCAR_COMPRAS,
                    Option::BUSCAR_ARTÍCULO,
                    Option::NUEVO_ARTICULO,
                    Option::PROVEEDORES,
                    Option::DESPACHAR_REQUISICION,
                    Option::USUARIOS,
                    Option::ROLES,
                    Option::CONFIGURACIONES,
                ]);
            });
        }

    }
}
