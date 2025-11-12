<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::firstOrCreate(['name' => 'Ver configuración']);
        Permission::firstOrCreate(['name' => 'Crear configuración']);
        Permission::firstOrCreate(['name' => 'Editar configuración']);
        Permission::firstOrCreate(['name' => 'Eliminar configuración']);

        Permission::firstOrCreate(['name' => 'Ver opcion menu']);
        Permission::firstOrCreate(['name' => 'Crear opcion menu']);
        Permission::firstOrCreate(['name' => 'Editar opcion menu']);
        Permission::firstOrCreate(['name' => 'Eliminar opcion menu']);

        Permission::firstOrCreate(['name' => 'Ver permisos']);
        Permission::firstOrCreate(['name' => 'Crear permisos']);
        Permission::firstOrCreate(['name' => 'Editar permisos']);
        Permission::firstOrCreate(['name' => 'Eliminar permisos']);

        Permission::firstOrCreate(['name' => 'Ver roles']);
        Permission::firstOrCreate(['name' => 'Crear roles']);
        Permission::firstOrCreate(['name' => 'Editar roles']);
        Permission::firstOrCreate(['name' => 'Eliminar roles']);

        Permission::firstOrCreate(['name' => 'Ver usuarios']);
        Permission::firstOrCreate(['name' => 'Crear usuarios']);
        Permission::firstOrCreate(['name' => 'Editar usuarios']);
        Permission::firstOrCreate(['name' => 'Eliminar usuarios']);


        Permission::firstOrCreate(['name' => 'Ver Requisición']);
        Permission::firstOrCreate(['name' => 'Crear Requisición']);
        Permission::firstOrCreate(['name' => 'Editar Requisición']);

        Permission::firstOrCreate(['name' => 'Autorizar Requisición']);
        Permission::firstOrCreate(['name' => 'Aprobar Requisición']);
        Permission::firstOrCreate(['name' => 'Despachar Requisición']);
        Permission::firstOrCreate(['name' => 'Anular Requisición']);



        Permission::firstOrCreate(['name' => 'Ver Compras']);
        Permission::firstOrCreate(['name' => 'Crear Compras']);
        Permission::firstOrCreate(['name' => 'Editar Compras']);
        Permission::firstOrCreate(['name' => 'Eliminar Compras']);

        Permission::firstOrCreate(['name' => 'Ver Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Compra Tipos']);


        Permission::firstOrCreate(['name' => 'Ver Categorías']);
        Permission::firstOrCreate(['name' => 'Crear Categorías']);
        Permission::firstOrCreate(['name' => 'Editar Categorías']);
        Permission::firstOrCreate(['name' => 'Eliminar Categorías']);

        Permission::firstOrCreate(['name' => 'Ver Artículos']);
        Permission::firstOrCreate(['name' => 'Crear Artículos']);
        Permission::firstOrCreate(['name' => 'Editar Artículos']);
        Permission::firstOrCreate(['name' => 'Eliminar Artículos']);

        Permission::firstOrCreate(['name' => 'Ver Magnitudes']);
        Permission::firstOrCreate(['name' => 'Crear Magnitudes']);
        Permission::firstOrCreate(['name' => 'Editar Magnitudes']);
        Permission::firstOrCreate(['name' => 'Eliminar Magnitudes']);

        Permission::firstOrCreate(['name' => 'Ver Marcas']);
        Permission::firstOrCreate(['name' => 'Crear Marcas']);
        Permission::firstOrCreate(['name' => 'Editar Marcas']);
        Permission::firstOrCreate(['name' => 'Eliminar Marcas']);

        Permission::firstOrCreate(['name' => 'Ver Proveedores']);
        Permission::firstOrCreate(['name' => 'Crear Proveedores']);
        Permission::firstOrCreate(['name' => 'Editar Proveedores']);
        Permission::firstOrCreate(['name' => 'Eliminar Proveedores']);

        Permission::firstOrCreate(['name' => 'Ver Renglones']);
        Permission::firstOrCreate(['name' => 'Crear Renglones']);
        Permission::firstOrCreate(['name' => 'Editar Renglones']);
        Permission::firstOrCreate(['name' => 'Eliminar Renglones']);

        Permission::firstOrCreate(['name' => 'Ver unidad medida']);
        Permission::firstOrCreate(['name' => 'Crear unidad medida']);
        Permission::firstOrCreate(['name' => 'Editar unidad medida']);
        Permission::firstOrCreate(['name' => 'Eliminar unidad medida']);


        Permission::firstOrCreate(['name' => 'Ver Activo Solicitud Estados']);
        Permission::firstOrCreate(['name' => 'Crear Activo Solicitud Estados']);
        Permission::firstOrCreate(['name' => 'Editar Activo Solicitud Estados']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Solicitud Estados']);

        Permission::firstOrCreate(['name' => 'Ver Activo Estados']);
        Permission::firstOrCreate(['name' => 'Crear Activo Estados']);
        Permission::firstOrCreate(['name' => 'Editar Activo Estados']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Estados']);

        Permission::firstOrCreate(['name' => 'Ver Activo Solicitud Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Activo Solicitud Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Activo Solicitud Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Solicitud Tipos']);

        Permission::firstOrCreate(['name' => 'Ver Activo Solicitudes']);
        Permission::firstOrCreate(['name' => 'Crear Activo Solicitudes']);
        Permission::firstOrCreate(['name' => 'Editar Activo Solicitudes']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Solicitudes']);

        Permission::firstOrCreate(['name' => 'Ver Activo Tarjetas']);
        Permission::firstOrCreate(['name' => 'Crear Activo Tarjetas']);
        Permission::firstOrCreate(['name' => 'Editar Activo Tarjetas']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Tarjetas']);

        Permission::firstOrCreate(['name' => 'Ver Activo Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Activo Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Activo Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Activo Tipos']);

        Permission::firstOrCreate(['name' => 'Ver Activos']);
        Permission::firstOrCreate(['name' => 'Crear Activos']);
        Permission::firstOrCreate(['name' => 'Editar Activos']);
        Permission::firstOrCreate(['name' => 'Eliminar Activos']);

        Permission::firstOrCreate(['name' => 'Ver Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Crear Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Editar Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Eliminar Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Aprobar Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Anular Solicitud de Compra']);
        Permission::firstOrCreate(['name' => 'Autorizar Solicitud de Compra']);

        Permission::firstOrCreate(['name' => 'Puede procesar ingreso de compra']);

        Permission::firstOrCreate(['name' => 'Ver Red Producción Resultados']);
        Permission::firstOrCreate(['name' => 'Crear Red Producción Resultados']);
        Permission::firstOrCreate(['name' => 'Editar Red Producción Resultados']);
        Permission::firstOrCreate(['name' => 'Eliminar Red Producción Resultados']);

        Permission::firstOrCreate(['name' => 'Ver Estructura Presupuestaria Programas']);
        Permission::firstOrCreate(['name' => 'Crear Estructura Presupuestaria Programas']);
        Permission::firstOrCreate(['name' => 'Editar Estructura Presupuestaria Programas']);
        Permission::firstOrCreate(['name' => 'Eliminar Estructura Presupuestaria Programas']);

        Permission::firstOrCreate(['name' => 'Editar insumos']);
        Permission::firstOrCreate(['name' => 'Crear insumos']);
        Permission::firstOrCreate(['name' => 'Eliminar insumos']);

    }
}
