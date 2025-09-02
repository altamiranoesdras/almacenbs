<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;


class
RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(["name" => "Developer"]);
        Role::firstOrCreate(["name" => "Superadmin"]);
        $rol= Role::firstOrCreate(["name" => "Admin"]);
        $rol->syncPermissions(Permission::pluck('name')->toArray());


        $rol = Role::firstOrCreate(["name" => "Solicitante Requisición Almacén"]);

        $rol->options()->sync([
            Option::MIS_REQUISICIONES_ALMACEN,
            Option::NUEVA_REQUISICION_ALMACEN,
        ]);

        $rol->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
        ]);

        $rol = Role::firstOrCreate(["name" => "Aprobador Requisición Almacén"]);

        $rol->options()->sync([
            Option::MIS_REQUISICIONES_ALMACEN,
            Option::NUEVA_REQUISICION_ALMACEN,
            Option::AUTORIZAR_REQUISICION_ALMACEN,
        ]);

        $rol = Role::firstOrCreate(["name" => "Administrador Requisición Almacén"]);

        $rol->options()->sync([
            Option::MIS_REQUISICIONES_ALMACEN,
            Option::NUEVA_REQUISICION_ALMACEN,
            Option::AUTORIZAR_REQUISICION_ALMACEN,
            Option::DESPACHAR_REQUISICION_ALMACEN,
            Option::BUSCAR_REQUISICION_ALMACEN,
        ]);


        Role::firstOrCreate(["name" => "Requirente Compras"]);//Solo crea la solicitud
        Role::firstOrCreate(["name" => "Solicitante Compras"]);//Consolidad solicitudes y crea requisición
        Role::firstOrCreate(["name" => "Aprobador Compras"]);//Aprueba la requisición
        Role::firstOrCreate(["name" => "Autorizador Compras"]);//Autoriza la requisición


        Role::firstOrCreate(["name" => "Analista Presupuesto"]);//Analiza el presupuesto
        Role::firstOrCreate(["name" => "Supervisor Presupuesto"]);//Supervisa el presupuesto
        Role::firstOrCreate(["name" => "Analista Compras"]);//Analiza las compras
        Role::firstOrCreate(["name" => "Supervisor Compras"]);//Supervisa las compras
        Role::firstOrCreate(["name" => "Administrador Compras"]);//Administra las compras


        //iterar todos los roles para asignar todos los permisos
        $roles = Role::all();
        foreach ($roles as $role) {
            $rol->syncPermissions(Permission::all()->pluck('name')->toArray());
        }

    }
}



