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

        $rolGeneral = Role::firstOrCreate(["name" => "Jefe Almacén"]);
        $rolGeneral = Role::firstOrCreate(["name" => "Jefe Inventarios"]);
        $rolGeneral = Role::firstOrCreate(["name" => "Asistente Caja"]);


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



