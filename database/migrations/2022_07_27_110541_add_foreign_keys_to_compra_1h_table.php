<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCompra1hTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compra_1h', function (Blueprint $table) {
            $table->foreign('compra_id', 'fk_compra_1h_compras1')->references('id')->on('compras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_procesa', 'fk_compra_1h_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('envio_fiscal_id', 'fk_compra_1h_envios_fiscales1')->references('id')->on('envios_fiscales')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compra_1h', function (Blueprint $table) {
            $table->dropForeign('fk_compra_1h_compras1');
            $table->dropForeign('fk_compra_1h_users1');
            $table->dropForeign('fk_compra_1h_envios_fiscales1');
        });
    }
}
