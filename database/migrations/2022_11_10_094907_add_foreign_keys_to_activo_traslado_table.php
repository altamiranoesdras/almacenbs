<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoTrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_traslado', function (Blueprint $table) {
            $table->foreign('tarjeta_detalle_id', 'fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_acti1')->references('id')->on('activo_tarjeta_detalles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('solicitud_detalle_id', 'fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_acti2')->references('id')->on('activo_solicitud_detalles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_traslado', function (Blueprint $table) {
            $table->dropForeign('fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_acti1');
            $table->dropForeign('fk_activo_tarjeta_detalles_has_activo_solicitud_detalles_acti2');
        });
    }
}
