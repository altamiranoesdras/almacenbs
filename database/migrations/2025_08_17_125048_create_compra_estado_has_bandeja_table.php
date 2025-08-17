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
        Schema::create('compra_estado_has_bandeja', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id')->index('fk_compra_requicicion_estados_has_compra_bandejas_compra_re_idx');
            $table->unsignedBigInteger('bandeja_id')->index('fk_compra_requicicion_estados_has_compra_bandejas_compra_ba_idx');

            $table->primary(['estado_id', 'bandeja_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_estado_has_bandeja');
    }
};
