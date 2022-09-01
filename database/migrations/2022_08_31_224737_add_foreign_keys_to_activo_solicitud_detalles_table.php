<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoSolicitudDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_solicitud_detalles', function (Blueprint $table) {
            $table->foreign('activo_id', 'fk_activo_solicitud_detalles_activos1')->references('id')->on('activos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('estado_id', 'fk_activo_solicitud_detalles_activo_estados1')->references('id')->on('activo_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('solicitud_id', 'fk_activo_solicitud_detalles_activo_solicitudes1')->references('id')->on('activo_solicitudes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('solicitud_tipo_id', 'fk_activo_solicitud_detalles_activo_solicitud_tipos1')->references('id')->on('activo_solicitud_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_solicitud_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_activo_solicitud_detalles_activos1');
            $table->dropForeign('fk_activo_solicitud_detalles_activo_estados1');
            $table->dropForeign('fk_activo_solicitud_detalles_activo_solicitudes1');
            $table->dropForeign('fk_activo_solicitud_detalles_activo_solicitud_tipos1');
        });
    }
}
