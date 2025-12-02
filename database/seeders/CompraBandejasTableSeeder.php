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


//        Paso NO.1
        $bandejaRequirenteCompras = CompraBandeja::create([
            'rol_id' => Role::REQUIRENTE_REQUISICION_COMPRAS,
            'nombre' => 'Requirente Compras',
            'descripcion' => 'Verifica datos, consolida las solicitudes y genera la requisición de compra. Al generar la solicitud se traslada hacia una bandeja para ser aprobada.',
        ]);
        $bandejaRequirenteCompras->estados()->attach([
            CompraRequisicionEstado::CREADA,
            CompraRequisicionEstado::REQUERIDA,
            CompraRequisicionEstado::APROBADA,
            CompraRequisicionEstado::AUTORIZADA,
            CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS,
            CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS,
            CompraRequisicionEstado::INICIO_DE_GESTION,
            CompraRequisicionEstado::EN_PROCESO_DE_GESTION,
            CompraRequisicionEstado::ENVIADA_A_PROVEEDORES,
            CompraRequisicionEstado::EN_ESPERA_DE_RESPUESTA_DE_PROVEEDORES,
            CompraRequisicionEstado::CUADRO_COMPARATIVO_GENERADO,
            CompraRequisicionEstado::ACTA_NEGOCIACION_GENERADA,
            CompraRequisicionEstado::ACTA_NEGOCIACION_AUTORIZADA,
            CompraRequisicionEstado::ADJUDICADA,
            CompraRequisicionEstado::ORDEN_DE_COMPRA_GENERADA,
            CompraRequisicionEstado::FINALIZADA,
            CompraRequisicionEstado::CANCELADA,
            CompraRequisicionEstado::ASIGNACION_REQUISICIONES,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_AUTORIZADOR,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_ANALISTA_DE_PRESUPUESTO,
            CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR,
            CompraRequisicionEstado::FUENTES_FINANCIAMIENTO_ASIGNADAS,
        ]);

//        Paso NO.2
        $bandejaAnalistaPresupuesto = CompraBandeja::create([
            'rol_id' => Role::ANALISTA_PRESUPUESTO,
            'nombre' => 'Analista de Presupuesto',
            'descripcion' => 'Analiza la requisición de compra desde el punto de vista presupuestario.',
        ]);
        $bandejaAnalistaPresupuesto->estados()->attach([
            CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_ANALISTA_DE_PRESUPUESTO,
            CompraRequisicionEstado::AUTORIZADA,
        ]);

//        Paso NO.3
        $bandejaAprobador = CompraBandeja::create([
            'rol_id' => Role::APROBADOR_REQUISICION_COMPRAS,
            'nombre' => 'Aprobador de Compras',
            'descripcion' => 'Aprueba la requisición de compra. Al generar la aprobación se traslada hacia una bandeja para ser autorizada.',
        ]);
        $bandejaAprobador->estados()->attach([
            CompraRequisicionEstado::REQUERIDA,
        ]);

//        Paso NO.4
        $bandejaAutorizador = CompraBandeja::create([
            'rol_id' => Role::AUTORIZADOR_REQUISICION_COMPRAS,
            'nombre' => 'Autorizador de Compras',
            'descripcion' => 'Autoriza la requisición de compra. Al generar la autorización se traslada hacia una bandeja para que el Jefe del Departamento de Compras verifique los datos de la requisición.',
        ]);
        $bandejaAutorizador->estados()->attach([
            CompraRequisicionEstado::APROBADA,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_AUTORIZADOR,
        ]);

//        Paso NO.5
        $bandejaSupervisor = CompraBandeja::create([
            'rol_id' => Role::SUPERVISOR_COMPRAS,
            'nombre' => 'Supervisor de Compras',
            'descripcion' => 'Verifica los datos de la requisición de compra antes de generar la orden de compra.',
        ]);

        $bandejaSupervisor->estados()->attach([
//            CompraRequisicionEstado::AUTORIZADA,
            CompraRequisicionEstado::ASIGNACION_REQUISICIONES,
            CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR,
        ]);

//        Paso NO.6
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
