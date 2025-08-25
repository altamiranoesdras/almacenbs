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
        Schema::create('compra_requisicion_proceso_has_estado', function (Blueprint $table) {
            $table->unsignedBigInteger('proceso_id')->index('fk_compra_requisicion_proceso_tipos_has_compra_requisicion__idx1');
            $table->unsignedBigInteger('estado_id')->index('fk_compra_requisicion_proceso_tipos_has_compra_requisicion__idx');

            $table->primary(['proceso_id', 'estado_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_proceso_has_estado');
    }
};
