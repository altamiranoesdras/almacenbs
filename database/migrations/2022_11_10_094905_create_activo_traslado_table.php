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
            $table->unsignedBigInteger('tarjeta_detalle_id')->index('fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_ac_idx1');
            $table->unsignedBigInteger('solicitud_detalle_id')->index('fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_ac_idx');
            $table->primary(['tarjeta_detalle_id', 'solicitud_detalle_id']);
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
