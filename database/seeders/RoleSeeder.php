<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Permission;
use App\Models\Renglon;
use App\Models\Role;
use Illuminate\Database\Seeder;



class RoleSeeder extends Seeder
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

        $role = Role::firstOrCreate(["name" => "General"]);

        $role->options()->sync([
            Option::MIS_REQUISICIONES,
            Option::NUEVA_REQUISICION,
        ]);

        $role->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
        ]);


        /**
         * @var Role $role
         */
        $role = Role::firstOrCreate(["name" => "Jefe almacen"]);

        $role->options()->sync(Option::all());

        $role->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
        ]);

    }
}



