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
        Schema::create('compra_requisicion_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('requisicion_id')->index('fk_compra_requisicion_detalles_compra_requisiciones1_idx');
            $table->unsignedBigInteger('solicitud_detalle_id')->index('fk_compra_requisicion_detalles_compra_solicitud_detalles1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_compra_requisicion_detalles_items1_idx');
            $table->decimal('cantidad', 14);
            $table->decimal('precio_estimado', 14);
            $table->string('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_detalles');
    }
};
