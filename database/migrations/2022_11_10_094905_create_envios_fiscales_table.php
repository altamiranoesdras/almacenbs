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
            $table->integer('nuemero_constancia');
            $table->string('serie_constancia');
            $table->date('fecha');
            $table->string('numero_cuenta');
            $table->string('forma');
            $table->integer('correlativo_del');
            $table->integer('correlativo_al');
            $table->integer('cantidad');
            $table->integer('pendientes');
            $table->string('serie');
            $table->string('numero');
            $table->string('libro');
            $table->integer('folio');
            $table->string('resolucion');
            $table->string('numero_gestion');
            $table->date('fecha_gestion');
            $table->string('correlativo');
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
