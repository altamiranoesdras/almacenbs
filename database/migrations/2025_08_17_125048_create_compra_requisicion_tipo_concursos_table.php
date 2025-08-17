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
        Schema::create('compra_requisicion_tipo_concursos', function (Blueprint $table) {
            $table->comment('ejecución directa
proceso competitivo');
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_tipo_concursos');
    }
};
