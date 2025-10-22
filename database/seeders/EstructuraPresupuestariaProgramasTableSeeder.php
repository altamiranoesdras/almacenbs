<?php

namespace Database\Seeders;

use App\Models\EstructuraPresupuestariaActividad;
use App\Models\EstructuraPresupuestariaPrograma;
use App\Models\EstructuraPresupuestariaProyecto;
use App\Models\EstructuraPresupuestariaSubprograma;
use App\Models\RedProduccionProducto;
use App\Models\RedProduccionResultado;
use App\Models\RedProduccionSubProducto;
use Illuminate\Database\Seeder;

class EstructuraPresupuestariaProgramasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        deshabilitaLlavesForaneas();


        EstructuraPresupuestariaPrograma::truncate();
        EstructuraPresupuestariaSubprograma::truncate();
        EstructuraPresupuestariaProyecto::truncate();
        EstructuraPresupuestariaActividad::truncate();


        EstructuraPresupuestariaPrograma::factory(10)
            //con subprogramas
            ->has(
                EstructuraPresupuestariaSubprograma::factory(3)
                    ->has(EstructuraPresupuestariaProyecto::factory(3)
                        ->has(EstructuraPresupuestariaActividad::factory(3),'actividades')
                    ,'proyectos')
                ,'subProgramas')
            ->create();

    }
}
