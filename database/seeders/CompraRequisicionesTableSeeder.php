<?php

namespace Database\Seeders;

use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicion\CompraRequisicionEstado;
use App\Models\CompraRequisicionDetalle;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CompraRequisicionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        deshabilitaLlavesForaneas();
        CompraRequisicion::truncate();
        CompraRequisicionDetalle::truncate();


        CompraRequisicion::factory()
            ->count(100)
            ->state(new Sequence(
                //mes pasado (1-7 días antes del inicio de mes)
                [
                    'created_at' => now()->startOfMonth()->subDays(rand(1, 7)),
                ],
                //mes actual (1-7 días después del inicio de mes)
                [
                    'created_at' => now()->startOfMonth()->addDays(rand(1,7)),
                ],
            ))
            //secuencia de estados
            ->state(new Sequence(
                ['estado_id' => CompraRequisicionEstado::CREADA],
                ['estado_id' => CompraRequisicionEstado::REQUERIDA],
                ['estado_id' => CompraRequisicionEstado::APROBADA],
                ['estado_id' => CompraRequisicionEstado::AUTORIZADA],
                ['estado_id' => CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS],
                ['estado_id' => CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS],
                ['estado_id' => CompraRequisicionEstado::INICIO_DE_GESTION],
                ['estado_id' => CompraRequisicionEstado::EN_PROCESO_DE_GESTION],
                ['estado_id' => CompraRequisicionEstado::ENVIADA_A_PROVEEDORES],
                ['estado_id' => CompraRequisicionEstado::EN_ESPERA_DE_RESPUESTA_DE_PROVEEDORES],
                ['estado_id' => CompraRequisicionEstado::CUADRO_COMPARATIVO_GENERADO],
                ['estado_id' => CompraRequisicionEstado::ACTA_NEGOCIACION_GENERADA],
                ['estado_id' => CompraRequisicionEstado::ACTA_NEGOCIACION_AUTORIZADA],
                ['estado_id' => CompraRequisicionEstado::ADJUDICADA],
                ['estado_id' => CompraRequisicionEstado::ORDEN_DE_COMPRA_GENERADA],
                ['estado_id' => CompraRequisicionEstado::FINALIZADA],
                ['estado_id' => CompraRequisicionEstado::CANCELADA],
            ))
            ->has(
                CompraRequisicionDetalle::factory()
                    ->state(new Sequence(
                        ['cantidad' => 25, 'precio' => 6],
                        ['cantidad' => 50, 'precio' => 7]
                    ))
                    ->count(rand(3,8)),
                'detalles'
            )
            ->afterCreating(function (CompraRequisicion $compra) {


            })
            ->create();


    }
}
