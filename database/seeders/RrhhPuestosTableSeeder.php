<?php

namespace Database\Seeders;

use App\Models\RrhhPuesto;
use Illuminate\Database\Seeder;

class RrhhPuestosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        RrhhPuesto::truncate();

        RrhhPuesto::factory()->create(['nombre' => 'JEFE DEPARTAMENTO ALMACÉN']);
        RrhhPuesto::factory()->create(['nombre' => 'ENCARGADA DE BODEGA']);
        RrhhPuesto::factory()->create(['nombre' => 'AUXILIAR DE BODEGA']);
        RrhhPuesto::factory()->create(['nombre' => 'ANALISTA ALMACÉN']);
        RrhhPuesto::factory()->create(['nombre' => 'RECEPCIONISTA']);
        RrhhPuesto::factory()->create(['nombre' => 'JEFE UNIDAD']);

    }
}
