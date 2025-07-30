<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Permission;
use App\Models\Renglon;
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

        $rolGeneral = Role::firstOrCreate(["name" => "General"]);

        $rolGeneral->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
        ]);

        $rolGeneral->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
        ]);

        $rol = Role::firstOrCreate(["name" => "Solicitante Requisición Compras"]);
        $rol = Role::firstOrCreate(["name" => "Aprobador Requisición Compras"]);
        $rol = Role::firstOrCreate(["name" => "Administrador Requisición Compras"]);

        $rol = Role::firstOrCreate(["name" => "Solicitante Requisición Almacén"]);
        $rol->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
        ]);

        $rol = Role::firstOrCreate(["name" => "Aprobador Requisición Almacén"]);

        $rol->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
            Option::APROBAR_REQISICION,
        ]);

        $rol = Role::firstOrCreate(["name" => "Administrador Requisición Almacén"]);

        $rol->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
            Option::APROBAR_REQISICION,
            Option::BUSCAR_REQUISICION,
        ]);


        //iterar todos los roles para asignar todos los permisos
        $roles = Role::all();
        foreach ($roles as $role) {
            $rol->syncPermissions(Permission::all()->pluck('name')->toArray());
        }



    }
}



