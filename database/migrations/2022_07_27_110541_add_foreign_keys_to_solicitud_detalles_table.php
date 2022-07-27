<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSolicitudDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_detalles', function (Blueprint $table) {
            $table->foreign('item_id', 'fk_solicitud_detalles_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('solicitud_id', 'fk_solicitud_detalles_solicitudes1')->references('id')->on('solicitudes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_solicitud_detalles_items1');
            $table->dropForeign('fk_solicitud_detalles_solicitudes1');
        });
    }
}
