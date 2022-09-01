<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoTarjetaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_tarjeta_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarjeta_id')->index('fk_activo_tarjeta_detalles_activo_tarjetas1_idx');
            $table->unsignedBigInteger('activo_id')->index('fk_activo_tarjeta_detalles_activos1_idx');
            $table->enum('tipo', ['alza', 'baja']);
            $table->integer('cantidad')->default(1);
            $table->decimal('valor', 14)->nullable();
            $table->unsignedBigInteger('unidad_id')->index('fk_activo_fijo_tarjeta_detalles_rrhh_unidades1_idx');
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
        Schema::dropIfExists('activo_tarjeta_detalles');
    }
}
