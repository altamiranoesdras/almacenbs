<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->char('dpi', 13)->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono', 45)->nullable();
            $table->text('direccion')->nullable();
            $table->char('nit', 10)->nullable();
            $table->unsignedBigInteger('puesto_id')->nullable()->index('fk_rrhh_colaboradores_rrhh_puestos1_idx');
            $table->unsignedBigInteger('unidad_id')->index('fk_rrhh_colaboradores_rrhh_unidades1_idx');
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_rrhh_colaboradores_users1_idx');
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
        Schema::dropIfExists('rrhh_colaboradores');
    }
}
