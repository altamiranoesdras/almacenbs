<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->unique();
            $table->string('name');
            $table->unsignedBigInteger('dpi')->nullable()->unique();
            $table->string('nit')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('bodega_id')->nullable()->index('fk_users_bodegas1_idx');
            $table->unsignedBigInteger('unidad_id')->nullable()->index('fk_users_rrhh_unidades1_idx');
            $table->unsignedBigInteger('puesto_id')->nullable()->index('fk_users_rrhh_puestos1_idx');
            $table->string('provider')->nullable();
            $table->string('provider_uid')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
