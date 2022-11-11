<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->foreign('estado_id', 'fk_activos_activo_estados1')->references('id')->on('activo_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('detalle_1h_id', 'fk_activos_compra_1h_detalles1')->references('id')->on('compra_1h_detalles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tipo_id', 'fk_activos_activo_tipos1')->references('id')->on('activo_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('renglon_id', 'fk_activos_renglon1')->references('id')->on('renglones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->dropForeign('fk_activos_activo_estados1');
            $table->dropForeign('fk_activos_compra_1h_detalles1');
            $table->dropForeign('fk_activos_activo_tipos1');
            $table->dropForeign('fk_activos_renglon1');
        });
    }
}
