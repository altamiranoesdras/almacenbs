<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStockInicialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_iniciales', function (Blueprint $table) {
            $table->foreign('item_id', 'fk_inistocks_items1')->references('id')->on('items');
            $table->foreign('user_id', 'inistocks_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_iniciales', function (Blueprint $table) {
            $table->dropForeign('fk_inistocks_items1');
            $table->dropForeign('inistocks_user_id_foreign');
        });
    }
}
