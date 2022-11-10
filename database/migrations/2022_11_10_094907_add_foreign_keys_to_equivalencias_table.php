<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEquivalenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equivalencias', function (Blueprint $table) {
            $table->foreign('item_origen', 'fk_equivalencias_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_destino', 'fk_equivalencias_items2')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equivalencias', function (Blueprint $table) {
            $table->dropForeign('fk_equivalencias_items1');
            $table->dropForeign('fk_equivalencias_items2');
        });
    }
}
