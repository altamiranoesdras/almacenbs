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
        Schema::create('compra_solicitudes', function (Blueprint $table) {
            $table->comment('Tabla que almacena las requisiciones de compras');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidad_id')->nullable()->index();
            $table->integer('correlativo')->nullable();
            $table->string('codigo', 10)->nullable();
            $table->date('fecha_solicita')->nullable();
            $table->text('justificacion')->nullable();
            $table->unsignedBigInteger('estado_id')->index();
            $table->unsignedBigInteger('usuario_solicita')->index();
            $table->unsignedBigInteger('usuario_verifica')->nullable()->index('compra_solicitudes_usuario_administra_index');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_solicitudes');
    }
};
