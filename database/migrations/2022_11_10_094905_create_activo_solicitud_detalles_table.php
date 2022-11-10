<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoSolicitudDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_solicitud_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->index('fk_activo_solicitud_detalles_activo_solicitudes1_idx');
            $table->unsignedBigInteger('activo_id')->index('fk_activo_solicitud_detalles_activos1_idx');
            $table->unsignedBigInteger('activo_tipo_id')->index('fk_activo_solicitud_detalles_activo_tipos1_idx');
            $table->unsignedBigInteger('solicitud_tipo_id')->index('fk_activo_solicitud_detalles_activo_solicitud_tipos1_idx');
            $table->enum('estado_del_bien', ['B', 'R', 'M'])->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activo_solicitud_detalles');
    }
}
