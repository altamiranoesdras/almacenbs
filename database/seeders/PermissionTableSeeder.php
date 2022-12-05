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

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Permission::truncate();

        Permission::firstOrCreate(['name' => 'dashboard']);
        Permission::firstOrCreate(['name' => 'Edita configuracion']);
        Permission::firstOrCreate(['name' => 'Eliminar configuracion']);

        Permission::firstOrCreate(['name' => 'Ver opcion menu']);
        Permission::firstOrCreate(['name' => 'Editar opcion menu']);
        Permission::firstOrCreate(['name' => 'Eliminar opcion menu']);
        Permission::firstOrCreate(['name' => 'Ver permiso']);
        Permission::firstOrCreate(['name' => 'Editar permiso']);
        Permission::firstOrCreate(['name' => 'Eliminar permiso']);
        Permission::firstOrCreate(['name' => 'Ver rol']);
        Permission::firstOrCreate(['name' => 'Editar rol']);
        Permission::firstOrCreate(['name' => 'Eliminar rol']);
        Permission::firstOrCreate(['name' => 'Ver usuario']);
        Permission::firstOrCreate(['name' => 'Editar usuario']);
        Permission::firstOrCreate(['name' => 'Editar menu usuario']);
        Permission::firstOrCreate(['name' => 'Eliminar usuario']);
        Permission::firstOrCreate(['name' => 'anular ingreso de compra']);
        Permission::firstOrCreate(['name' => 'cancelar solicitud de compra']);
        Permission::firstOrCreate(['name' => 'filtrar por bodega compras']);
        Permission::firstOrCreate(['name' => 'ver ganancia compra']);
        Permission::firstOrCreate(['name' => 'ver detalle gasto']);
        Permission::firstOrCreate(['name' => 'editar gasto']);
        Permission::firstOrCreate(['name' => 'eliminar gasto']);
        Permission::firstOrCreate(['name' => 'todas las opciones menu']);
        Permission::firstOrCreate(['name' => 'cambiar de bodega']);
        Permission::firstOrCreate(['name' => 'ver detalles solicitud']);
        Permission::firstOrCreate(['name' => 'eliminar solicitud']);
        Permission::firstOrCreate(['name' => 'anular solicitud']);
        Permission::firstOrCreate(['name' => 'eliminar requisición']);
        Permission::firstOrCreate(['name' => 'Admin Tenant']);
        Permission::firstOrCreate(['name' => 'Admin Hosts']);
        Permission::firstOrCreate(['name' => 'Admin Plans']);
        Permission::firstOrCreate(['name' => 'Admin Subscripciones']);
        Permission::firstOrCreate(['name' => 'eliminar hostname']);
        Permission::firstOrCreate(['name' => 'eliminar plan']);
        Permission::firstOrCreate(['name' => 'eliminar user']);
        Permission::firstOrCreate(['name' => 'anular venta']);
        Permission::firstOrCreate(['name' => 'cambia venta a credito']);
        Permission::firstOrCreate(['name' => 'filtrar por bodega ventas']);
        Permission::firstOrCreate(['name' => 'Administrar']);
        Permission::firstOrCreate(['name' => 'ver roles user']);
        Permission::firstOrCreate(['name' => 'editar caja']);
        Permission::firstOrCreate(['name' => 'Reporte ganancias']);
        Permission::firstOrCreate(['name' => 'ver todas las ventas']);
        Permission::firstOrCreate(['name' => 'ver todas las compras']);

        Permission::firstOrCreate(['name' => 'Ver requisición']);
        Permission::firstOrCreate(['name' => 'Editar requisición']);
        Permission::firstOrCreate(['name' => 'Anular requisición']);
        Permission::firstOrCreate(['name' => 'Autorizar requisición']);
        Permission::firstOrCreate(['name' => 'Aprobar requisición']);
        Permission::firstOrCreate(['name' => 'Despachar requisición']);

        Permission::firstOrCreate(['name' => 'Ver Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Crear Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Editar Compra1Hs']);
        Permission::firstOrCreate(['name' => 'Eliminar Compra1Hs']);

        Permission::firstOrCreate(['name' => 'Ver Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Crear Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Editar Compra Tipos']);
        Permission::firstOrCreate(['name' => 'Eliminar Compra Tipos']);
        Permission::firstOrCreate(['name' => 'anular ingreso de compra']);
        Permission::firstOrCreate(['name' => 'cancelar solicitud de compra']);

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
