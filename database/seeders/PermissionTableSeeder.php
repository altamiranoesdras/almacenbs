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

        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'Edita configuracion']);
        Permission::create(['name' => 'Eliminar configuracion']);

        Permission::create(['name' => 'Ver opcion menu']);
        Permission::create(['name' => 'Editar opcion menu']);
        Permission::create(['name' => 'Eliminar opcion menu']);
        Permission::create(['name' => 'Ver permiso']);
        Permission::create(['name' => 'Editar permiso']);
        Permission::create(['name' => 'Eliminar permiso']);
        Permission::create(['name' => 'Ver rol']);
        Permission::create(['name' => 'Editar rol']);
        Permission::create(['name' => 'Eliminar rol']);
        Permission::create(['name' => 'Ver usuario']);
        Permission::create(['name' => 'Editar usuario']);
        Permission::create(['name' => 'Editar menu usuario']);
        Permission::create(['name' => 'Eliminar usuario']);
        Permission::create(['name' => 'anular ingreso de compra']);
        Permission::create(['name' => 'cancelar solicitud de compra']);
        Permission::create(['name' => 'filtrar por bodega compras']);
        Permission::create(['name' => 'ver ganancia compra']);
        Permission::create(['name' => 'ver detalle gasto']);
        Permission::create(['name' => 'editar gasto']);
        Permission::create(['name' => 'eliminar gasto']);
        Permission::create(['name' => 'todas las opciones menu']);
        Permission::create(['name' => 'cambiar de bodega']);
        Permission::create(['name' => 'ver detalles solicitud']);
        Permission::create(['name' => 'eliminar solicitud']);
        Permission::create(['name' => 'anular solicitud']);
        Permission::create(['name' => 'eliminar requisición']);
        Permission::create(['name' => 'Admin Tenant']);
        Permission::create(['name' => 'Admin Hosts']);
        Permission::create(['name' => 'Admin Plans']);
        Permission::create(['name' => 'Admin Subscripciones']);
        Permission::create(['name' => 'eliminar hostname']);
        Permission::create(['name' => 'eliminar plan']);
        Permission::create(['name' => 'eliminar user']);
        Permission::create(['name' => 'anular venta']);
        Permission::create(['name' => 'cambia venta a credito']);
        Permission::create(['name' => 'filtrar por bodega ventas']);
        Permission::create(['name' => 'Administrar']);
        Permission::create(['name' => 'ver roles user']);
        Permission::create(['name' => 'editar caja']);
        Permission::create(['name' => 'Reporte ganancias']);
        Permission::create(['name' => 'ver todas las ventas']);
        Permission::create(['name' => 'ver todas las compras']);

        Permission::create(['name' => 'Ver requisición']);
        Permission::create(['name' => 'Editar requisición']);
        Permission::create(['name' => 'Anular requisición']);
        Permission::create(['name' => 'Autorizar requisición']);
        Permission::create(['name' => 'Aprobar requisición']);
        Permission::create(['name' => 'Despachar requisición']);

        Permission::create(['name' => 'Ver Compra1Hs']);
        Permission::create(['name' => 'Crear Compra1Hs']);
        Permission::create(['name' => 'Editar Compra1Hs']);
        Permission::create(['name' => 'Eliminar Compra1Hs']);

        Permission::create(['name' => 'Ver Compra Tipos']);
        Permission::create(['name' => 'Crear Compra Tipos']);
        Permission::create(['name' => 'Editar Compra Tipos']);
        Permission::create(['name' => 'Eliminar Compra Tipos']);
        Permission::create(['name' => 'anular ingreso de compra']);
        Permission::create(['name' => 'cancelar solicitud de compra']);

        Permission::create(['name' => 'Ver Categorías']);
        Permission::create(['name' => 'Crear Categorías']);
        Permission::create(['name' => 'Editar Categorías']);
        Permission::create(['name' => 'Eliminar Categorías']);

        Permission::create(['name' => 'Ver Item Tipos']);
        Permission::create(['name' => 'Crear Item Tipos']);
        Permission::create(['name' => 'Editar Item Tipos']);
        Permission::create(['name' => 'Eliminar Item Tipos']);

        Permission::create(['name' => 'Ver Artículos']);
        Permission::create(['name' => 'Crear Artículos']);
        Permission::create(['name' => 'Editar Artículos']);
        Permission::create(['name' => 'Eliminar Artículos']);

        Permission::create(['name' => 'Ver Proveedores']);
        Permission::create(['name' => 'Crear Proveedores']);
        Permission::create(['name' => 'Editar Proveedores']);
        Permission::create(['name' => 'Eliminar Proveedores']);




    }
}
