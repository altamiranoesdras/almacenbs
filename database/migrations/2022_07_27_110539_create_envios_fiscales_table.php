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
            $table->string('serie_constancia', 10);
            $table->date('fecha');
            $table->string('numero_cuenta', 45);
            $table->string('forma', 45);
            $table->integer('correlativo_del');
            $table->integer('correlativo_al');
            $table->integer('cantidad');
            $table->integer('pendientes');
            $table->string('serie', 45);
            $table->string('numero', 45);
            $table->string('libro', 45);
            $table->integer('folio');
            $table->string('resolucion', 45);
            $table->string('numero_gestion', 45);
            $table->date('fecha_gestion');
            $table->string('correlativo', 45);
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
