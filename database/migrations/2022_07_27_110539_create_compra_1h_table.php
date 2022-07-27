<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompra1hTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_1h', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('compra_id')->index('fk_compra_1h_compras1_idx');
            $table->unsignedInteger('envio_fiscal_id')->index('fk_compra_1h_envios_fiscales1_idx');
            $table->string('codigo', 45)->nullable();
            $table->integer('correlativo')->nullable();
            $table->integer('del')->nullable();
            $table->integer('al')->nullable();
            $table->dateTime('fecha_procesa')->nullable();
            $table->unsignedInteger('usuario_procesa')->index('fk_compra_1h_users1_idx');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('compra_1h');
    }
}
