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
        Schema::table('compra_requisicion_tipo_adquisicion_has_proceso', function (Blueprint $table) {
            $table->foreign(['tipo_adquisicion_id'], 'fk_compra_requisicion_tipo_adquisiciones_has_compra_requisici1')->references(['id'])->on('compra_requisicion_tipo_adquisiciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['proceso_id'], 'fk_compra_requisicion_tipo_adquisiciones_has_compra_requisici2')->references(['id'])->on('compra_requisicion_proceso_tipos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisicion_tipo_adquisicion_has_proceso', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requisicion_tipo_adquisiciones_has_compra_requisici1');
            $table->dropForeign('fk_compra_requisicion_tipo_adquisiciones_has_compra_requisici2');
        });
    }
};
