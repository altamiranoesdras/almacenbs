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
        Schema::create('compra_requisiciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tipo_concurso_id')->index('fk_compra_requisiciones_compra_requisicion_tipo_concursos1_idx');
            $table->unsignedBigInteger('ipo_adquisicion_id')->index('fk_compra_requisiciones_compra_requicicion_adquisicion_tipo_idx');
            $table->integer('correlativo')->nullable();
            $table->string('codigo', 20)->comment('ID interno de gestión, p.ej. G-2025-001');
            $table->string('codigo_consolidacion', 45)->nullable()->comment('Código de lote interno, p.ej. L-2025-001');
            $table->string('npg', 45)->nullable()->comment('Número de Publicación (Compra Menor)');
            $table->string('nog', 45)->nullable()->comment('Número de Operación (Licitación Abreviada)');
            $table->unsignedBigInteger('proveedor_adjudicado')->nullable()->index('fk_compra_requisiciones_proveedores1_idx');
            $table->string('numero_adjudicacion', 45)->nullable();
            $table->unsignedBigInteger('estado_id')->index('fk_compra_solicitud_gestiones_compra_solicitud_gestion_esta_idx');
            $table->string('subproductos', 45)->nullable();
            $table->string('partidas', 45)->nullable();
            $table->text('observaciones')->nullable();
            $table->text('justificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisiciones');
    }
};
