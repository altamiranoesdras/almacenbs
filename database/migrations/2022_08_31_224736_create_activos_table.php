<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_inventario', 100);
            $table->string('folio', 100)->nullable();
            $table->text('descripcion');
            $table->decimal('valor', 14)->nullable();
            $table->date('fecha_registra');
            $table->unsignedBigInteger('tipo_id')->index('fk_activos_activo_tipos1_idx');
            $table->unsignedBigInteger('detalle_1h_id')->nullable()->index('fk_activos_compra_1h_detalles1_idx');
            $table->unsignedBigInteger('estado_id')->index('fk_activos_activo_estados1_idx');
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
        Schema::dropIfExists('activos');
    }
}
