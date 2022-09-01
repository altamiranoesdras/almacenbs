<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_solicitudes', function (Blueprint $table) {
            $table->foreign('usuario_inventario', 'fk_activo_solicitudes_users4')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unidad_origen', 'fk_activo_solicitudes_rrhh_unidades1')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_origen', 'fk_activo_solicitudes_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('estado_id', 'fk_activo_solicitudes_activo_solicitud_estados1')->references('id')->on('activo_solicitud_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_autoriza', 'fk_activo_solicitudes_users3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tarjeta_id', 'fk_activo_solicitudes_activo_tarjetas1')->references('id')->on('activo_tarjetas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unidad_destino', 'fk_activo_solicitudes_rrhh_unidades2')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_destino', 'fk_activo_solicitudes_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tipo_id', 'fk_activo_solicitudes_activo_solicitud_tipos1')->references('id')->on('activo_solicitud_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_solicitudes', function (Blueprint $table) {
            $table->dropForeign('fk_activo_solicitudes_users4');
            $table->dropForeign('fk_activo_solicitudes_rrhh_unidades1');
            $table->dropForeign('fk_activo_solicitudes_users1');
            $table->dropForeign('fk_activo_solicitudes_activo_solicitud_estados1');
            $table->dropForeign('fk_activo_solicitudes_users3');
            $table->dropForeign('fk_activo_solicitudes_activo_tarjetas1');
            $table->dropForeign('fk_activo_solicitudes_rrhh_unidades2');
            $table->dropForeign('fk_activo_solicitudes_users2');
            $table->dropForeign('fk_activo_solicitudes_activo_solicitud_tipos1');
        });
    }
}
