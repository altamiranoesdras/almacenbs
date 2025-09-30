<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Option;
use App\Models\Role;
use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
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
            'email' => 'altamiranoesdras@gmail.com',
            "password" => bcrypt("Sbs2025**"),
            'bodega_id' => Bodega::PRINCIPAL,
            'unidad_id' => RrhhUnidad::PRINCIPAL,
            'puesto_id' => null,
        ])->each(function (User $user){
            $user->syncRoles([Role::DEVELOPER]);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::MIS_REQUISICIONES_ALMACEN,
                Option::NUEVO_INGRESO_ALMACEN,
                Option::BUSCAR_INGRESOS_A_ALMACEN,
                Option::BUSCAR_INSUMOS,
                Option::NUEVO_INSUMO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION_ALMACEN,
                Option::USUARIOS,
                Option::ROLES,
                Option::CONFIGURACIONES,
            ]);
        });

        User::factory(1)->create([
            "username" => "Superadmin",
            "name" => "Super Admin",
            "password" => bcrypt("Sbs2025**"),
            'bodega_id' => Bodega::PRINCIPAL,
            'unidad_id' => RrhhUnidad::PRINCIPAL,
            'puesto_id' => null,
        ])->each(function (User $user){
            $user->syncRoles(Role::SUPERADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::MIS_REQUISICIONES_ALMACEN,
                Option::NUEVO_INGRESO_ALMACEN,
                Option::BUSCAR_INGRESOS_A_ALMACEN,
                Option::BUSCAR_INSUMOS,
                Option::NUEVO_INSUMO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION_ALMACEN,
                Option::USUARIOS,
                Option::ROLES,
                Option::CONFIGURACIONES,
            ]);
        });

        User::factory(1)->create([
            "username" => "Admin",
            "name" => "Administrador",
            "password" => bcrypt("Sbs2025**"),
            'bodega_id' => Bodega::PRINCIPAL,
            'unidad_id' => RrhhUnidad::PRINCIPAL,
            'puesto_id' => null,
        ])->each(function (User $user){
            $user->syncRoles(Role::ADMIN);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                Option::MIS_REQUISICIONES_ALMACEN,
                Option::NUEVO_INGRESO_ALMACEN,
                Option::BUSCAR_INGRESOS_A_ALMACEN,
                Option::BUSCAR_INSUMOS,
                Option::NUEVO_INSUMO,
                Option::PROVEEDORES,
                Option::DESPACHAR_REQUISICION_ALMACEN,
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
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'elena.lucas',
                'name' => 'ELENA JUAN LUCAS',
                'email' => 'elena.lucas@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'antonio.rodriguez',
                'name' => 'ANTONIO RODRÍGUEZ',
                'email' => 'operativos.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::AUXILIAR_DE_BODEGA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'lilian.valle',
                'name' => 'LILIAN MARBETTI VALLE ORDÓÑEZ',
                'email' => 'almacen.asistente@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ANALISTA_ALMACEN,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'martha.ramos',
                'name' => 'MARTHA YESENIA RAMOS FUENTES',
                'email' => 'recepcion.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::RECEPCIONISTA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'mynor.medina',
                'name' => 'MYNOR MANUEL MEDINA GODÍNEZ',
                'email' => 'mynor.medina@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'cesar.vicente',
                'name' => 'CÉSAR AUGUSTO VICENTE RODRÍGUEZ',
                'email' => 'cesar.vicente@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::ENCARGADA_DE_BODEGA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
            [
                'username' => 'roberto.tiul',
                'name' => 'ROBERTO TIUL ICHICH',
                'email' => 'operativos2.almacen@sbs.gob.gt',
                'puesto_id' => RrhhPuesto::AUXILIAR_DE_BODEGA,
                'bodega_id' => Bodega::PRINCIPAL,
                'unidad_id' => RrhhUnidad::ALMACEN
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::factory(1)->create([
                'username' => $usuario['username'],
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'password' => bcrypt('Sbs2025**'),
                'bodega_id' => $usuario['bodega_id'],
                'unidad_id' => $usuario['unidad_id'],
                'puesto_id' => $usuario['puesto_id'],
            ])->each(function (User $user) {
                $user->syncRoles(Role::ADMINISTRADOR_REQUISICION_ALMACEN);

                $user->shortcuts()->sync([
                    Option::MIS_REQUISICIONES_ALMACEN,
                    Option::NUEVO_INGRESO_ALMACEN,
                    Option::BUSCAR_INGRESOS_A_ALMACEN,
                    Option::BUSCAR_INSUMOS,
                    Option::NUEVO_INSUMO,
                    Option::PROVEEDORES,
                ]);
            });
        }

    }
}
