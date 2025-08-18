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
        Schema::create('compra_solicitud_estados', function (Blueprint $table) {
            $table->comment('Solicitud Compra estados
	Temporal
	Ingresada
	Solicitada
	Asignda a Requisición
	Cancelada');
            $table->id();
            $table->string('nombre', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_solicitud_estados');
    }
};
