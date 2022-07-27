<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_id')->index('fk_compras_compras_tipos1_idx');
            $table->unsignedInteger('proveedor_id')->index('fk_compra_proveedores1_idx');
            $table->string('codigo', 45)->nullable();
            $table->integer('correlativo')->nullable();
            $table->date('fecha_documento')->nullable()->comment('Fecha del docuemnto de  la Factura');
            $table->date('fecha_ingreso')->nullable()->comment('Fecha de ingreso al sistema');
            $table->string('serie', 45)->nullable();
            $table->string('numero', 20)->nullable();
            $table->unsignedInteger('estado_id')->index('fk_compras_compra_estados1_idx');
            $table->unsignedInteger('usuario_crea')->index('user_id');
            $table->unsignedInteger('usuario_recibe')->nullable()->index('fk_compras_users2_idx');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
