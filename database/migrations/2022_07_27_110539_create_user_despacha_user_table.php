<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDespachaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_despacha_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_sol')->index('fk_users_has_users_users1_idx');
            $table->unsignedBigInteger('user_des')->index('fk_users_has_users_users2_idx');
            $table->primary(['user_sol', 'user_des']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_despacha_user');
    }
}
