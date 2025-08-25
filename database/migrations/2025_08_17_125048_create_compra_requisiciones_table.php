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
            $table->id();
            $table->unsignedBigInteger('tipo_concurso_id')->index('fk_compra_requisiciones_compra_requisicion_tipo_concursos1_idx')->nullable();
            $table->unsignedBigInteger('ipo_adquisicion_id')->index('fk_compra_requisiciones_compra_requisicion_adquisicion_tipo_idx')->nullable();
            $table->integer('correlativo')->nullable();
            $table->string('codigo', 20)->comment('ID interno de gestión, p.ej. G-2025-001')->nullable();
            $table->string('codigo_consolidacion', 45)->nullable()->comment('Código de lote interno, p.ej. L-2025-001');
            $table->string('npg', 45)->nullable()->comment('Número de Publicación (Compra Menor)');
            $table->string('nog', 45)->nullable()->comment('Número de Operación (Licitación Abreviada)');

            $table->foreignId('usuario_crea_id')->constrained('users');
            $table->foreignId('usuario_aprueba_id')->nullable()->constrained('users');
            $table->foreignId('usuario_autoriza_id')->nullable()->constrained('users');
            $table->foreignId('usuario_asigna_id')->nullable()->constrained('users');
            $table->foreignId('usuario_analista_id')->nullable()->constrained('users');

            $table->foreignId('unidad_id')->constrained('rrhh_unidades');


            $table->unsignedBigInteger('proveedor_adjudicado')->nullable()->index('fk_compra_requisiciones_proveedores1_idx');
            $table->string('numero_adjudicacion')->nullable();
            $table->unsignedBigInteger('estado_id')->index('fk_compra_solicitud_gestiones_compra_solicitud_gestion_esta_idx');
            $table->string('subproductos')->nullable();


            $table->string('partidas')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('justificacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropForeign(['tipo_concurso_id']);
            $table->dropForeign(['ipo_adquisicion_id']);
            $table->dropForeign(['usuario_crea_id']);
            $table->dropForeign(['usuario_aprueba_id']);
            $table->dropForeign(['usuario_autoriza_id']);
            $table->dropForeign(['usuario_asigna_id']);
            $table->dropForeign(['usuario_analista_id']);
            $table->dropForeign(['unidad_id']);
            $table->dropForeign(['proveedor_adjudicado']);
            $table->dropForeign(['estado_id']);
        });

        Schema::dropIfExists('compra_requisiciones');
    }
};
