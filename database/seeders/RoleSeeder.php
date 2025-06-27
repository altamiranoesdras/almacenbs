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
        $role= Role::firstOrCreate(["name" => "Admin"]);
        $role->syncPermissions(Permission::pluck('name')->toArray());

        $roleGeneral = Role::firstOrCreate(["name" => "General"]);

        $roleGeneral->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
        ]);

        $roleGeneral->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
        ]);

        $role = Role::firstOrCreate(["name" => "Solicitante Requisición Compras"]);
        $role = Role::firstOrCreate(["name" => "Solicitante Requisición Almacén"]);

        $role = Role::firstOrCreate(["name" => "Aprobador Requisición Compras"]);
        $role = Role::firstOrCreate(["name" => "Aprobador Requisición Almacén"]);

        $role = Role::firstOrCreate(["name" => "Administrador Requisición Compras"]);
        $role = Role::firstOrCreate(["name" => "Administrador Requisición Almacén"]);




    }
}



