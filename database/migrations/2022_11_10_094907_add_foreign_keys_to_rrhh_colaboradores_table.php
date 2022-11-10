<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRrhhColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rrhh_colaboradores', function (Blueprint $table) {
            $table->foreign('puesto_id', 'fk_rrhh_colaboradores_rrhh_puestos1')->references('id')->on('rrhh_puestos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'fk_rrhh_colaboradores_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unidad_id', 'fk_rrhh_colaboradores_rrhh_unidades1')->references('id')->on('rrhh_unidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_colaboradores', function (Blueprint $table) {
            $table->dropForeign('fk_rrhh_colaboradores_rrhh_puestos1');
            $table->dropForeign('fk_rrhh_colaboradores_users1');
            $table->dropForeign('fk_rrhh_colaboradores_rrhh_unidades1');
        });
    }
}
