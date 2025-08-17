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
        Schema::create('compra_orden_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orden_id')->index('fk_compra_orden_detalles_compra_ordenes1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_compra_orden_detalles_items1_idx');
            $table->decimal('cantidad', 14);
            $table->decimal('precio', 14);
            $table->string('observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_orden_detalles');
    }
};
