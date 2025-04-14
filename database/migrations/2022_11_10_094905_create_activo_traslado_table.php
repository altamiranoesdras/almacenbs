<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoTrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_traslado', function (Blueprint $table) {
            $table->unsignedBigInteger('tarjeta_detalle_id')->index();
            $table->unsignedBigInteger('solicitud_detalle_id')->index();
            $table->primary(['tarjeta_detalle_id', 'solicitud_detalle_id'], 'activo_traslado_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activo_traslado');
    }
}
