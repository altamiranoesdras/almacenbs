<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_tarjetas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colaborador_id')->index('fk_activo_tarjetas_rrhh_colaboradores1_idx');
            $table->string('codigo', 45)->nullable();
            $table->string('codigo_interno', 45)->nullable();
            $table->integer('correlativo')->nullable();
            $table->boolean('impreso')->nullable();
            $table->unsignedBigInteger('estado_id')->default(1)->index('fk_activo_tarjetas_activo_tarjeta_estados1_idx');
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
        Schema::dropIfExists('activo_tarjetas');
    }
}
