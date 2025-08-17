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
        Schema::create('compra_ordenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gestion_id')->index('fk_compra_ordenes_compra_solicitud_gestiones1_idx');
            $table->unsignedBigInteger('proveedor_id')->index('fk_compra_ordenes_proveedores1_idx');
            $table->string('numero', 50);
            $table->dateTime('fecha');
            $table->enum('estado', ['emitida', 'recibida', 'pagada'])->default('emitida');
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_ordenes');
    }
};
