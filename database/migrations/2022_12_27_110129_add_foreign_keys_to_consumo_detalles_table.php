<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConsumoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumo_detalles', function (Blueprint $table) {
            $table->foreign('consumo_id', 'fk_consumo_detalles_consumos1')->references('id')->on('consumos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_id', 'fk_consumo_detalles_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumo_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_consumo_detalles_consumos1');
            $table->dropForeign('fk_consumo_detalles_items1');
        });
    }
}
