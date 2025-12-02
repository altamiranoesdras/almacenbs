<?php

namespace Database\Seeders;

use App\Models\CompraRequisicionEstado;
use Illuminate\Database\Seeder;

class CompraRequisicionEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Para ejecutar este seeder: php artisan db:seed --class="Database\Seeders\CompraRequisicionEstadosTableSeeder"
     * @return void
     */
    public function run()
    {
        deshabilitaLlavesForaneas();

        CompraRequisicionEstado::truncate();


        $estados = [
            ['nombre' => 'CREADA'],
            ['nombre' => 'REQUERIDA'],
            ['nombre' => 'APROBADA'],
            ['nombre' => 'AUTORIZADA'],
            ['nombre' => 'ASIGNADA A ANALISTA DE PRESUPUESTOS'],
            ['nombre' => 'ASIGNADA A ANALISTA DE COMPRAS'],
            ['nombre' => 'INICIO DE GESTIÓN'],
            ['nombre' => 'EN PROCESO DE GESTIÓN'],
            ['nombre' => 'ENVIADA A PROVEEDORES'],
            ['nombre' => 'EN ESPERA DE RESPUESTA DE PROVEEDORES'],
            ['nombre' => 'CUADRO COMPARATIVO GENERADO'],
            ['nombre' => 'ACTA NEGOCIACIÓN GENERADA (FIRMAS ELECTRÓNICAS)'],
            ['nombre' => 'ACTA NEGOCIACIÓN AUTORIZADA'],
            ['nombre' => 'ADJUDICADA'],
            ['nombre' => 'ORDEN DE COMPRA GENERADA'],
            ['nombre' => 'FINALIZADA'],
            ['nombre' => 'CANCELADA'],
            ['nombre' => 'ASIGNACION DE REQUISICIONES'],
            ['nombre' => 'RETORNADA POR SUPERVISOR A AUTORIZADOR'],
            ['nombre' => 'RETORNADA POR SUPERVISOR A ANALISTA DE PRESUPUESTO'],
            ['nombre' => 'RETORNADA POR ANALISTA DE PRESUPUESTO A SUPERVISOR'],
            ['nombre' => 'FUENTES FINANCIAMIENTO ASIGNADAS'],
        ];

        foreach ($estados as $estado) {
            CompraRequisicionEstado::create($estado);
        }


    }
}
