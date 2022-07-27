<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKardexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kardexs', function (Blueprint $table) {
            $table->foreign('item_id', 'fk_kardexs_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_id', 'fk_kardexs_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kardexs', function (Blueprint $table) {
            $table->dropForeign('fk_kardexs_items1');
            $table->dropForeign('fk_kardexs_users1');
        });
    }
}
