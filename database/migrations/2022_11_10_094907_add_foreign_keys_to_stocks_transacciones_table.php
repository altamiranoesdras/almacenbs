<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStocksTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks_transacciones', function (Blueprint $table) {
            $table->foreign('stock_id', 'fk_stocks_egresos_stocks1')->references('id')->on('stocks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks_transacciones', function (Blueprint $table) {
            $table->dropForeign('fk_stocks_egresos_stocks1');
        });
    }
}
