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
            $table->foreign(['requisicion_id'], 'fk_compra_requisicion_detalles_compra_requisiciones1')->references(['id'])->on('compra_requisiciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['solicitud_detalle_id'], 'fk_compra_requisicion_detalles_compra_solicitud_detalles1')->references(['id'])->on('compra_solicitud_detalles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['item_id'], 'fk_compra_requisicion_detalles_items1')->references(['id'])->on('items')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisicion_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requisicion_detalles_compra_requisiciones1');
            $table->dropForeign('fk_compra_requisicion_detalles_compra_solicitud_detalles1');
            $table->dropForeign('fk_compra_requisicion_detalles_items1');
        });
    }
};
