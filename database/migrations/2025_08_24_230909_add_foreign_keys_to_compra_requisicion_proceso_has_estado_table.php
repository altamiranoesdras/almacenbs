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
        Schema::table('compra_requisicion_proceso_has_estado', function (Blueprint $table) {
            $table->foreign(['proceso_id'], 'fk_compra_requisicion_proceso_tipos_has_compra_requisicion_es1')->references(['id'])->on('compra_requisicion_proceso_tipos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'], 'fk_compra_requisicion_proceso_tipos_has_compra_requisicion_es2')->references(['id'])->on('compra_requisicion_estados')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisicion_proceso_has_estado', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requisicion_proceso_tipos_has_compra_requisicion_es1');
            $table->dropForeign('fk_compra_requisicion_proceso_tipos_has_compra_requisicion_es2');
        });
    }
};
