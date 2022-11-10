<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToActivoTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activo_tarjetas', function (Blueprint $table) {
            $table->foreign('colaborador_id', 'fk_activo_tarjetas_rrhh_colaboradores1')->references('id')->on('rrhh_colaboradores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activo_tarjetas', function (Blueprint $table) {
            $table->dropForeign('fk_activo_tarjetas_rrhh_colaboradores1');
        });
    }
}
