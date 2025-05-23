<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRrhhUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rrhh_unidades', function (Blueprint $table) {
            $table->foreign('jefe_id', 'fk_rrhh_unidades_rrhh_colaboradores1')->references('id')->on('rrhh_colaboradores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_unidades', function (Blueprint $table) {
            $table->dropForeign('fk_rrhh_unidades_rrhh_colaboradores1');
        });
    }
}
