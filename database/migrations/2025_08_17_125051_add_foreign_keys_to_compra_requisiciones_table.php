<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->foreign(['ipo_adquisicion_id'], 'fk_compra_requisiciones_compra_requicicion_adquisicion_tipos1')->references(['id'])->on('compra_requicicion_tipo_adquisiciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_concurso_id'], 'fk_compra_requisiciones_compra_requisicion_tipo_concursos1')->references(['id'])->on('compra_requisicion_tipo_concursos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['proveedor_adjudicado'], 'fk_compra_requisiciones_proveedores1')->references(['id'])->on('proveedores')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'], 'fk_compra_solicitud_gestiones_compra_solicitud_gestion_estados1')->references(['id'])->on('compra_requicicion_estados')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requisiciones_compra_requicicion_adquisicion_tipos1');
            $table->dropForeign('fk_compra_requisiciones_compra_requisicion_tipo_concursos1');
            $table->dropForeign('fk_compra_requisiciones_proveedores1');
            $table->dropForeign('fk_compra_solicitud_gestiones_compra_solicitud_gestion_estados1');
        });
    }
};
