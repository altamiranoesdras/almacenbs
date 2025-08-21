<?php

namespace Database\Seeders\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicionEstado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraRequisicionEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Para ejecutar este seeder: php artisan db:seed --class="Database\Seeders\CompraRequisicion\CompraRequisicionEstadosTableSeeder"
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        CompraRequisicionEstado::truncate();

        CompraRequisicionEstado::create([
            'nombre' => 'Creada / Consolidación solicitudes',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Evaluando proveedores (proceso competitivo)',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Cuadro Comparativo Generado',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Acta negociación generada (firmas electronicas)',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Acta Negociación Autorizada',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Adjudicada',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Orden compra generada',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Finalizada',
            'tipo_proceso' => 'NPG',
        ]);

        CompraRequisicionEstado::create([
            'nombre' => 'Cancelada',
            'tipo_proceso' => 'NPG',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
