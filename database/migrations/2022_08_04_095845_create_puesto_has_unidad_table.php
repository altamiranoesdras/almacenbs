<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestoHasUnidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_has_unidad', function (Blueprint $table) {
            $table->unsignedBigInteger('puesto_id')->index('fk_rrhh_puestos_has_rrhh_unidades_rrhh_puestos1_idx');
            $table->unsignedBigInteger('unidad_id')->index('fk_rrhh_puestos_has_rrhh_unidades_rrhh_unidades1_idx');
            $table->primary(['puesto_id', 'unidad_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puesto_has_unidad');
    }
}
