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
        Schema::table('compra_requisicion_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requisicion_detalles_compra_solicitud_detalles1');
            $table->dropColumn('solicitud_detalle_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisicion_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitud_detalle_id')
                ->nullable()
                ->index('fk_compra_requisicion_detalles_compra_solicitud_detalles1_idx');

            $table->foreign('solicitud_detalle_id', 'fk_compra_requisicion_detalles_compra_solicitud_detalles1')
                ->references('id')
                ->on('compra_solicitud_detalles')
                ->onDelete('cascade');
        });
    }
};
