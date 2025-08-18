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
        Schema::create('compra_requisicion_estados', function (Blueprint $table) {
            $table->comment('Solicitud Requisición Estados

	NPG


		Creada / Consolidacion solicitudes

		Evaluando proveedores (proceso competitivo)
		Cuadro Comparativo Generado


		Acta negociación generada (firmas electronicas)
		Acta Negociación Autorizada

		Adjudicada
		Orden compra generada

		Finalizada

		Cancelada

	NOG

		Creada / Consolidacion solicitudes

		Evaluando proveedores (proceso competitivo)
		Cuadro Comparativo Generado

		Acta negociación generada (firmas electronicas)
		Acta Negociación Autorizada

		Adjudicada
		Orden compra generada

		Finalizada

		Cancelada

');
            $table->id();
            $table->string('nombre');
            $table->enum('tipo_proceso', ['NOG', 'NPG'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_estados');
    }
};
