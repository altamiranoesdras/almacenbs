<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->foreign('usuario_despacha', 'fk_solicitudes_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_solicita', 'fk_solicitudes_users4')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('estado_id', 'fk_solicitudes_estados1')->references('id')->on('solicitud_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_crea', 'fk_solicitudes_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_autoriza', 'fk_solicitudes_users3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_aprueba', 'fk_solicitudes_users5')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unidad_id', 'fk_solicitudes_rrhh_unidades1')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign('fk_solicitudes_users2');
            $table->dropForeign('fk_solicitudes_users4');
            $table->dropForeign('fk_solicitudes_estados1');
            $table->dropForeign('fk_solicitudes_users1');
            $table->dropForeign('fk_solicitudes_users3');
            $table->dropForeign('fk_solicitudes_users5');
            $table->dropForeign('fk_solicitudes_rrhh_unidades1');
        });
    }
}
