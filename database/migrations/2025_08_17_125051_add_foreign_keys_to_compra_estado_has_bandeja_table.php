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
        Schema::table('compra_estado_has_bandeja', function (Blueprint $table) {
            $table->foreign(['bandeja_id'], 'fk_compra_requicicion_estados_has_compra_bandejas_compra_band1')->references(['id'])->on('compra_bandejas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'], 'fk_compra_requicicion_estados_has_compra_bandejas_compra_requ1')->references(['id'])->on('compra_requicicion_estados')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_estado_has_bandeja', function (Blueprint $table) {
            $table->dropForeign('fk_compra_requicicion_estados_has_compra_bandejas_compra_band1');
            $table->dropForeign('fk_compra_requicicion_estados_has_compra_bandejas_compra_requ1');
        });
    }
};
