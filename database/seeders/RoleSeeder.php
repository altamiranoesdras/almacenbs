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

        $role->options()->sync([
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

        $role->syncPermissions([
            'Ver Requisición',
            'Crear Requisición',
            'Editar Requisición',
            'Autorizar Requisición',
            'Aprobar Requisición',
            'Despachar Requisición',
            'Anular Requisición',
            'Ver Compras',
            'Crear Compras',
            'Editar Compras',
            'Eliminar Compras',
            'Ver Compra Tipos',
            'Crear Compra Tipos',
            'Editar Compra Tipos',
            'Eliminar Compra Tipos',
            'Ver Categorías',
            'Crear Categorías',
            'Editar Categorías',
            'Eliminar Categorías',
            'Ver Artículos',
            'Crear Artículos',
            'Editar Artículos',
            'Eliminar Artículos',
            'Ver Magnitudes',
            'Crear Magnitudes',
            'Editar Magnitudes',
            'Eliminar Magnitudes',
            'Ver Marcas',
            'Crear Marcas',
            'Editar Marcas',
            'Eliminar Marcas',
            'Ver Proveedores',
            'Crear Proveedores',
            'Editar Proveedores',
            'Eliminar Proveedores',
            'Ver Renglones',
            'Crear Renglones',
            'Editar Renglones',
            'Eliminar Renglones',
            'Ver unidad medida',
            'Crear unidad medida',
            'Editar unidad medida',
            'Eliminar unidad medida',
        ]);

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



