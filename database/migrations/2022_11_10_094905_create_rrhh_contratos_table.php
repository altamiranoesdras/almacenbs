<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colaborador_id')->index('fk_rrhh_contratos_rrhh_colaboradores1_idx');
            $table->unsignedBigInteger('unidad_id')->index('fk_rrhh_contratos_rrhh_unidades1_idx');
            $table->unsignedBigInteger('puesto_id')->nullable()->index('fk_rrhh_contratos_rrhh_puestos1_idx');
            $table->string('numero');
            $table->date('inicio');
            $table->date('fin')->nullable();
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
        Schema::dropIfExists('rrhh_contratos');
    }
}
