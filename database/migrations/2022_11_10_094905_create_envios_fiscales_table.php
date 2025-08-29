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
            $table->integer('correlativo_del');
            $table->integer('correlativo_al');
            $table->integer('folio_inicial');
            $table->integer('folio_actual');
            $table->integer('nuemero_constancia')->nullable();
            $table->string('serie_constancia')->nullable();
            $table->date('fecha')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('forma')->nullable();
            $table->string('serie')->nullable();
            $table->string('numero')->nullable();
            $table->string('libro')->nullable();
            $table->integer('folio')->nullable();
            $table->string('resolucion')->nullable();
            $table->string('numero_gestion')->nullable();
            $table->date('fecha_gestion')->nullable();
            $table->string('correlativo')->nullable();
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
