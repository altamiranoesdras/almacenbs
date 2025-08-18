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
        Schema::table('compra_solicitud_detalles', function (Blueprint $table) {
            $table->foreign(['solicitud_id'])->references(['id'])->on('compra_solicitudes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['item_id'], 'fk_compra_solicitud_detalles_items1')->references(['id'])->on('items')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitud_detalles', function (Blueprint $table) {
            $table->dropForeign('compra_solicitud_detalles_solicitud_id_foreign');
            $table->dropForeign('fk_compra_solicitud_detalles_items1');
        });
    }
};
