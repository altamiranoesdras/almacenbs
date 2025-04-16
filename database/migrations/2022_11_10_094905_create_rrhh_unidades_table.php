<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_unidades', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique('rrhh_unidades_codigo_UNIQUE');
            $table->string('nombre');
            $table->unsignedBigInteger('jefe_id')->nullable()->index('fk_rrhh_unidades_rrhh_colaboradores1_idx');
            $table->enum('activa', ['si', 'no'])->default('si');
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
        Schema::dropIfExists('rrhh_unidades');
    }
}
