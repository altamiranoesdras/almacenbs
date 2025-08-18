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
        Schema::create('compra_solicitud_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->index();
            $table->unsignedBigInteger('item_id')->index('fk_compra_solicitud_detalles_items1_idx');
            $table->integer('cantidad');
            $table->decimal('precio_estimado', 14);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_solicitud_detalles');
    }
};
