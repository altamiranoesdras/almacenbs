<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_item', function (Blueprint $table) {
            $table->foreign('activo_id', 'fk_activos_has_items_activos1')->references('id')->on('activos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_id', 'fk_activos_has_items_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_item', function (Blueprint $table) {
            $table->dropForeign('fk_activos_has_items_activos1');
            $table->dropForeign('fk_activos_has_items_items1');
        });
    }
}
