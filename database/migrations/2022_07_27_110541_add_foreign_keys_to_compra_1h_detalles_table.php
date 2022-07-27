<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCompra1hDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compra_1h_detalles', function (Blueprint $table) {
            $table->foreign('1h_id', 'fk_compra_1h_detalles_compra_1h1')->references('id')->on('compra_1h')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_id', 'fk_compra_1h_detalles_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compra_1h_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_compra_1h_detalles_compra_1h1');
            $table->dropForeign('fk_compra_1h_detalles_items1');
        });
    }
}
