<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingKeys2ToActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->foreign('renglon_id', 'fk_activos_renglones1')->references('id')->on('renglones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_asignado_id', 'fk_activos_usuarios1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->dropForeign('fk_activos_renglones1');
            $table->dropForeign('fk_activos_usuarios1');
        });
    }
}
