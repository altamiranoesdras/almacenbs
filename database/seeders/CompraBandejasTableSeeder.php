<?php

namespace Database\Seeders;

use App\Models\CompraBandeja;
use App\Models\CompraRequisicionEstado;
use App\Models\Role;
use Illuminate\Database\Seeder;


class CompraBandejasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        \DB::table('compra_estado_has_bandeja')->truncate();

        CompraBandeja::truncate();

        $bandejaSolicitante = CompraBandeja::create([
            'rol_id' => Role::SOLICITANTE_REQUISICION_COMPRAS,
            'nombre' => 'Solicitante Compras',
            'descripcion' => 'Verifica datos, consolida las solicitudes y genera la requisición de compra. Al generar la solicitud se traslada hacia una bandeja para ser aprobada.',
        ]);

        $bandejaSolicitante->estados()->attach([
            CompraRequisicionEstado::CREADA,
            CompraRequisicionEstado::REQUERIDA,
        ]);

        $bandejaAprobador = CompraBandeja::create([
            'rol_id' => Role::APROBADOR_REQUISICION_COMPRAS,
            'nombre' => 'Aprobador de Compras',
            'descripcion' => 'Aprueba la requisición de compra. Al generar la aprobación se traslada hacia una bandeja para ser autorizada.',
        ]);

        $bandejaAprobador->estados()->attach([
            CompraRequisicionEstado::REQUERIDA,
        ]);

        $bandejaAutorizador = CompraBandeja::create([
            'rol_id' => Role::AUTORIZADOR_REQUISICION_COMPRAS,
            'nombre' => 'Autorizador de Compras',
            'descripcion' => 'Autoriza la requisición de compra. Al generar la autorización se traslada hacia una bandeja para que el Jefe del Departamento de Compras verifique los datos de la requisición.',
        ]);

        $bandejaAutorizador->estados()->attach([
            CompraRequisicionEstado::APROBADA,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_AUTORIZADOR,
        ]);

        $bandejaSupervisor = CompraBandeja::create([
            'rol_id' => Role::SUPERVISOR_COMPRAS,
            'nombre' => 'Supervisor de Compras',
            'descripcion' => 'Verifica los datos de la requisición de compra antes de generar la orden de compra.',
        ]);

        $bandejaSupervisor->estados()->attach([
            CompraRequisicionEstado::AUTORIZADA,
            CompraRequisicionEstado::ASIGNACION_REQUISICIONES,
            CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR,
        ]);

        $bandejaAnalistaPresupuesto = CompraBandeja::create([
            'rol_id' => Role::ANALISTA_PRESUPUESTO,
            'nombre' => 'Analista de Presupuesto',
            'descripcion' => 'Analiza la requisición de compra desde el punto de vista presupuestario.',
        ]);

        $bandejaAnalistaPresupuesto->estados()->attach([
            CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_ANALISTA_DE_PRESUPUESTO,
        ]);

        $bandejaAnalistaCompras = CompraBandeja::create([
            'rol_id' => Role::ANALISTA_COMPRAS,
            'nombre' => 'Analista de Compras',
            'descripcion' => 'Analiza la requisición de compra desde el punto de vista de compras.',
        ]);

        $bandejaAnalistaCompras->estados()->attach([
            CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS,
            CompraRequisicionEstado::INICIO_DE_GESTION,
        ]);
    }
}
