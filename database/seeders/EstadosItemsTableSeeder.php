<?php
namespace Database\Seeders;

use App\Models\Iestado;
use Illuminate\Database\Seeder;

class EstadosItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Iestado::create(['descripcion' => 'Activo']);
        Iestado::create(['descripcion' => 'Inactivo']);
        Iestado::create(['descripcion' => 'Caducado']);
    }
}
