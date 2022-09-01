<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoTarjetaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_tarjeta_detalles', function (Blueprint $table) {
            $table->foreign('unidad_id', 'fk_activo_fijo_tarjeta_detalles_rrhh_unidades1')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('activo_id', 'fk_activo_tarjeta_detalles_activos1')->references('id')->on('activos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tarjeta_id', 'fk_activo_tarjeta_detalles_activo_tarjetas1')->references('id')->on('activo_tarjetas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_tarjeta_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_activo_fijo_tarjeta_detalles_rrhh_unidades1');
            $table->dropForeign('fk_activo_tarjeta_detalles_activos1');
            $table->dropForeign('fk_activo_tarjeta_detalles_activo_tarjetas1');
        });
    }
}
