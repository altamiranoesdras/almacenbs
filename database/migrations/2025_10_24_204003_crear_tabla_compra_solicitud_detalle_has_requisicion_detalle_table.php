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
        Schema::create('compra_solicitud_detalle_has_requisicion_detalle', function (Blueprint $table) {
            $table->unsignedBigInteger('compra_solicitud_detalle_id');
            $table->unsignedBigInteger('requisicion_detalle_id');

            $table->foreign('compra_solicitud_detalle_id', 'fk_csd_hrd_csd')
                ->references('id')
                ->on('compra_solicitud_detalles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('requisicion_detalle_id', 'fk_csd_hrd_rd')
                ->references('id')
                ->on('compra_requisicion_detalles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['compra_solicitud_detalle_id', 'requisicion_detalle_id'], 'pk_csd_hrd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitud_detalle_has_requisicion_detalle', function (Blueprint $table) {
            $table->dropForeign('fk_csd_hrd_csd');
            $table->dropForeign('fk_csd_hrd_rd');
        });

        Schema::dropIfExists('compra_solicitud_detalle_has_requisicion_detalle');
    }
};
