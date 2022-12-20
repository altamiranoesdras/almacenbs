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
        $role = Role::firstOrCreate(["name" => "Jefe almacén"]);

        $role->options()->sync([
            Option::PANEL_DE_CONTROL,
//            Option::NUEVA_COMPRA_SOLA,
            Option::NUEVA_COMPRA,
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

        $role->syncPermissions(Permission::all());

        /**
         * @var Role $role
         */
        $role = Role::firstOrCreate(["name" => "Jefe inventarios"]);

        $role->options()->sync([
            Option::INVENTARIOS,
            Option::ACTIVOS,
            Option::TARJETA_RESPONSABILIDAD,
            Option::INGRESO_INVENTARIO_1H,
            Option::SOLICITUD_CD_BIENES,
            Option::RPT_BIENES_POR_UNIDAD,
        ]);

        $role->syncPermissions([
            'Ver Activo Solicitud Estados',
            'Crear Activo Solicitud Estados',
            'Editar Activo Solicitud Estados',
            'Eliminar Activo Solicitud Estados',
            'Ver Activo Estados',
            'Crear Activo Estados',
            'Editar Activo Estados',
            'Eliminar Activo Estados',
            'Ver Activo Solicitud Tipos',
            'Crear Activo Solicitud Tipos',
            'Editar Activo Solicitud Tipos',
            'Eliminar Activo Solicitud Tipos',
            'Ver Activo Solicitudes',
            'Crear Activo Solicitudes',
            'Editar Activo Solicitudes',
            'Eliminar Activo Solicitudes',
            'Ver Activo Tarjetas',
            'Crear Activo Tarjetas',
            'Editar Activo Tarjetas',
            'Eliminar Activo Tarjetas',
            'Ver Activo Tipos',
            'Crear Activo Tipos',
            'Editar Activo Tipos',
            'Eliminar Activo Tipos',
            'Ver Activos',
            'Crear Activos',
            'Editar Activos',
            'Eliminar Activos',
        ]);

    }
}



