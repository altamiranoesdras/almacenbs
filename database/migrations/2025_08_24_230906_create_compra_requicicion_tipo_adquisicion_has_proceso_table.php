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
        Schema::create('compra_requisicion_tipo_adquisicion_has_proceso', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_adquisicion_id')->index('fk_compra_requisicion_tipo_adquisiciones_has_compra_requisi_idx1');
            $table->unsignedBigInteger('proceso_id')->index('fk_compra_requisicion_tipo_adquisiciones_has_compra_requisi_idx');

            $table->primary(['tipo_adquisicion_id', 'proceso_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_tipo_adquisicion_has_proceso');
    }
};
