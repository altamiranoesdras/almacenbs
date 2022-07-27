<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserDespachaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_despacha_user', function (Blueprint $table) {
            $table->foreign('user_sol', 'fk_users_has_users_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_des', 'fk_users_has_users_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_despacha_user', function (Blueprint $table) {
            $table->dropForeign('fk_users_has_users_users1');
            $table->dropForeign('fk_users_has_users_users2');
        });
    }
}
