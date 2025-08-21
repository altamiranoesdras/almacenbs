<?php

namespace Database\Seeders\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicionEstado;
use Illuminate\Database\Seeder;

class CompraRequisicionEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Para ejecutar este seeder: php artisan db:seed --class="Database\Seeders\CompraRequisicion\CompraRequisicionEstadosTableSeeder"
     * @return void
     */
    public function run()
    {
        deshabilitaLlavesForaneas();

        CompraRequisicionEstado::truncate();

        $estados = [
            ['nombre' => 'Creada / Consolidación solicitudes', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Evaluando proveedores (proceso competitivo)', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Cuadro Comparativo Generado', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Acta negociación generada (firmas electrónicas)', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Acta Negociación Autorizada', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Adjudicada', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Orden compra generada', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Finalizada', 'tipo_proceso' => 'NPG'],
            ['nombre' => 'Cancelada', 'tipo_proceso' => 'NPG'],

            ['nombre' => 'Creada / Consolidación solicitudes', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Evaluando proveedores (proceso competitivo)', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Cuadro Comparativo Generado', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Acta negociación generada (firmas electrónicas)', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Acta Negociación Autorizada', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Adjudicada', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Orden compra generada', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Finalizada', 'tipo_proceso' => 'NOG'],
            ['nombre' => 'Cancelada', 'tipo_proceso' => 'NOG'],
        ];

        foreach ($estados as $estado) {
            CompraRequisicionEstado::create($estado);
        }

        habilitaLlavesForaneas();
    }
}
