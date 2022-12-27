<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->id();
            $table->integer('correlativo')->nullable();
            $table->string('codigo')->nullable();
            $table->unsignedBigInteger('estado_id')->index('fk_consumos_consumos_estados1_idx');
            $table->unsignedBigInteger('unidad_id')->nullable()->index('fk_consumos_rrhh_unidades1_idx');
            $table->unsignedBigInteger('bodega_id')->nullable()->index('fk_consumos_bodegas1_idx');
            $table->unsignedBigInteger('usuario_crea')->index('fk_consumos_users1_idx');

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
        Schema::dropIfExists('consumos');
    }
}
