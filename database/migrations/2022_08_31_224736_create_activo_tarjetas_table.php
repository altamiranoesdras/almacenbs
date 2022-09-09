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
            $table->unsignedBigInteger('responsable_id')->index('fk_activo_fijo_tarjetas_users1_idx');
            $table->string('codigo', 45)->nullable();
            $table->string('codigo_referencia')->nullable();
            $table->integer('correlativo')->nullable();
            $table->boolean('impreso')->nullable();
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
