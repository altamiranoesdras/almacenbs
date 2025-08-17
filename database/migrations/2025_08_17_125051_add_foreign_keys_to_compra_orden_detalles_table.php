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
        Schema::table('compra_orden_detalles', function (Blueprint $table) {
            $table->foreign(['orden_id'], 'fk_compra_orden_detalles_compra_ordenes1')->references(['id'])->on('compra_ordenes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['item_id'], 'fk_compra_orden_detalles_items1')->references(['id'])->on('items')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_orden_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_compra_orden_detalles_compra_ordenes1');
            $table->dropForeign('fk_compra_orden_detalles_items1');
        });
    }
};
