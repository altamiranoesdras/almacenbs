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
        Schema::create('compra_solicitud_has_requisicion', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitud_id')->index('fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_idx');
            $table->unsignedBigInteger('requisicion_id')->index('fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_idx1');

            $table->primary(['solicitud_id', 'requisicion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_solicitud_has_requisicion');
    }
};
