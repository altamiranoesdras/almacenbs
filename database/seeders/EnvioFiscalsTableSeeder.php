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
            'correlativo_del' => 1000,
            'correlativo_al' => 10000,
            'folio_inicial' => 50,
            'folio_actual' => 50,
        ]);

        EnvioFiscal::factory()->count(1)->create([
            'nombre_tabla' => 'compra_requisiciones',
            'correlativo_del' => 1000,
            'correlativo_al' => 10000,
            'folio_inicial' => 50,
            'folio_actual' => 50,
        ]);
    }
}
