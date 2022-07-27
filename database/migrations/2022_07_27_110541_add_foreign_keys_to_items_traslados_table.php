<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTrasladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_traslados', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_items_traslados_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('estado_id', 'fk_items_traslados_estados1')->references('id')->on('items_traslados_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_destino', 'fk_items_traslados_items2')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_origen', 'fk_items_traslados_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_traslados', function (Blueprint $table) {
            $table->dropForeign('fk_items_traslados_users1');
            $table->dropForeign('fk_items_traslados_estados1');
            $table->dropForeign('fk_items_traslados_items2');
            $table->dropForeign('fk_items_traslados_items1');
        });
    }
}
