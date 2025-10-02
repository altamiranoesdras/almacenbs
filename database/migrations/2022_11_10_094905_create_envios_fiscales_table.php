<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosFiscalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_fiscales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tabla');
            $table->string('numero_resolucion')->nullable();
            $table->string('numero_gestion')->nullable();
            $table->date('fecha_gestion')->nullable();
            $table->string('correlativo_resolucion')->nullable();
            $table->date('fecha_correlativo_resolucion')->nullable();
            $table->string('serie_envio')->nullable();
            $table->string('numero_envio')->nullable();
            $table->date('fecha_envio')->nullable();


            $table->integer('correlativo_del');
            $table->integer('correlativo_al');
            $table->integer('correlativo_inicial');
            $table->integer('correlativo_actual');

//            $table->integer('numero_constancia')->nullable();
//            $table->string('numero_cuenta')->nullable();
//            $table->string('forma')->nullable();
            $table->string('libro')->nullable();
            $table->integer('folio')->nullable();
            $table->enum('activo', ['si', 'no'])->nullable()->default('si');
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
        Schema::dropIfExists('envios_fiscales');
    }
}
