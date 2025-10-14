<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        Permission::truncate();

        Permission::firstOrCreate(['name' => 'dashboard']);

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


        Permission::firstOrCreate(['name' => 'Ver usuario']);
        Permission::firstOrCreate(['name' => 'Crear usuario']);
        Permission::firstOrCreate(['name' => 'Editar usuario']);
        Permission::firstOrCreate(['name' => 'Eliminar usuario']);
        Permission::firstOrCreate(['name' => 'Editar menu usuario']);


        Permission::firstOrCreate(['name' => 'Ver Requisición']);
        Permission::firstOrCreate(['name' => 'Crear Requisición']);
        Permission::firstOrCreate(['name' => 'Editar Requisición']);
        Permission::firstOrCreate(['name' => 'Eliminar Requisición']);


        Permission::firstOrCreate(['name' => 'Anular Requisición']);
        Permission::firstOrCreate(['name' => 'Autorizar Requisición']);
        Permission::firstOrCreate(['name' => 'Aprobar Requisición']);
        Permission::firstOrCreate(['name' => 'Despachar Requisición']);


        Permission::firstOrCreate(['name' => 'Ver Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Crear Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Editar Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Eliminar Compra1Hs']);


        Permission::firstOrCreate(['name' => 'Ver Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Compra Tipos']);


        Permission::firstOrCreate(['name' => 'Ver Compras']);
        Permission::firstOrCreate(['name' => 'Crear Compras']);
        Permission::firstOrCreate(['name' => 'Editar Compras']);
        Permission::firstOrCreate(['name' => 'Eliminar Compras']);
        Permission::firstOrCreate(['name' => 'Anular Ingreso de almacén']);


        Permission::firstOrCreate(['name' => 'Ver Categorías']);
        Permission::firstOrCreate(['name' => 'Crear Categorías']);
        Permission::firstOrCreate(['name' => 'Editar Categorías']);
        Permission::firstOrCreate(['name' => 'Eliminar Categorías']);


        Permission::firstOrCreate(['name' => 'Ver Item Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Item Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Item Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Item Tipos']);


        Permission::firstOrCreate(['name' => 'Ver Artículos']);
        Permission::firstOrCreate(['name' => 'Crear Artículos']);
        Permission::firstOrCreate(['name' => 'Editar Artículos']);
        Permission::firstOrCreate(['name' => 'Eliminar Artículos']);


        Permission::firstOrCreate(['name' => 'Ver Proveedores']);
        Permission::firstOrCreate(['name' => 'Crear Proveedores']);
        Permission::firstOrCreate(['name' => 'Editar Proveedores']);
        Permission::firstOrCreate(['name' => 'Eliminar Proveedores']);




    }
}
