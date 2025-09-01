<?php

namespace Database\Seeders;

use App\Models\EnvioFiscal;
use Illuminate\Database\Seeder;

class EnvioFiscalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();
        EnvioFiscal::truncate();

        EnvioFiscal::factory()->count(1)->create([
            'nombre_tabla' => 'compras',
            'correlativo_del' => 1,
            'correlativo_al' => 2000,
            'folio_inicial' => 1,
            'folio_actual' => 40,
            'activo' => 'si'
        ]);

        EnvioFiscal::factory()->count(1)->create([
            'nombre_tabla' => 'solicitudes',
            'correlativo_del' => 1,
            'correlativo_al' => 7500,
            'folio_inicial' => 1,
            'folio_actual' => 1,
            'activo' => 'si'
        ]);
    }
}
