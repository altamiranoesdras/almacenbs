<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumos', function (Blueprint $table) {
            $table->foreign('estado_id', 'fk_consumos_consumos_estados1')->references('id')->on('consumo_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_crea', 'fk_consumos_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumos', function (Blueprint $table) {
            $table->dropForeign('fk_consumos_consumos_estados1');
            $table->dropForeign('fk_consumos_users1');
        });
    }
}
