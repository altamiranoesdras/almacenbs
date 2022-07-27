<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->nullable();
            $table->integer('correlativo')->nullable();
            $table->text('justificacion')->nullable();
            $table->unsignedInteger('unidad_id')->index('fk_solicitudes_rrhh_unidades1_idx');
            $table->unsignedInteger('usuario_crea')->index('fk_solicitudes_users1_idx');
            $table->unsignedInteger('usuario_solicita')->nullable()->index('fk_solicitudes_users4_idx');
            $table->unsignedInteger('usuario_autoriza')->nullable()->index('fk_solicitudes_users3_idx');
            $table->unsignedInteger('usuario_aprueba')->nullable()->index('fk_solicitudes_users5_idx');
            $table->unsignedInteger('usuario_despacha')->nullable()->index('fk_solicitudes_users2_idx');
            $table->string('firma_requiere')->nullable();
            $table->string('firma_autoriza')->nullable();
            $table->string('firma_aprueba')->nullable();
            $table->string('firma_almacen')->nullable();
            $table->dateTime('fecha_solicita');
            $table->dateTime('fecha_autoriza')->nullable();
            $table->dateTime('fecha_aprueba')->nullable();
            $table->dateTime('fecha_almacen_firma')->nullable();
            $table->dateTime('fecha_informa')->nullable();
            $table->dateTime('fecha_despacha')->nullable();
            $table->unsignedInteger('estado_id')->index('fk_solicitudes_solicitud_estados1_idx');
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
        Schema::dropIfExists('solicitudes');
    }
}
