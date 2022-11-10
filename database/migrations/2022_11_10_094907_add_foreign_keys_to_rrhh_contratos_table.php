<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRrhhContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rrhh_contratos', function (Blueprint $table) {
            $table->foreign('colaborador_id', 'fk_rrhh_contratos_rrhh_colaboradores1')->references('id')->on('rrhh_colaboradores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unidad_id', 'fk_rrhh_contratos_rrhh_unidades1')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('puesto_id', 'fk_rrhh_contratos_rrhh_puestos1')->references('id')->on('rrhh_puestos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_contratos', function (Blueprint $table) {
            $table->dropForeign('fk_rrhh_contratos_rrhh_colaboradores1');
            $table->dropForeign('fk_rrhh_contratos_rrhh_unidades1');
            $table->dropForeign('fk_rrhh_contratos_rrhh_puestos1');
        });
    }
}
