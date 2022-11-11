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
            $table->string('nombre', 255)->nullable();
            $table->text('descripcion');
            $table->string('codigo_inventario', 100);
            $table->string('folio', 100)->nullable();
            $table->decimal('valor_actual',14,2)->nullable();
            $table->decimal('valor_adquisicion',14,2)->nullable();
            $table->decimal('valor_contabilizado',14,2)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->unsignedBigInteger('tipo_id')->index('fk_activos_activo_tipos1_idx');
            $table->unsignedBigInteger('estado_id')->index('fk_activos_activo_estados1_idx');
            $table->unsignedBigInteger('renglon_id')->nullable()->index('fk_activos_renglones1_idx');
            $table->unsignedBigInteger('detalle_1h_id')->nullable()->index('fk_activos_compra_1h_detalles1_idx');
            $table->integer('entidad')->nullable();
            $table->integer('unidad_ejecutadora')->nullable();
            $table->integer('tipo_inventario')->nullable();
            $table->string('codigo_sicoin')->nullable();
            $table->integer('codigo_donacion')->nullable();
            $table->string('nit')->nullable();
            $table->string('numero_documento')->nullable();
            $table->date('fecha_aprobado')->nullable();
            $table->date('fecha_contabilizacion')->nullable();
            $table->string('cur')->nullable();
            $table->string('contabilizado')->nullable();
            $table->integer('diferencia_act_adq')->nullable();
            $table->integer('diferencia_act_cont')->nullable();
            $table->integer('diferencia_adq_cont')->nullable();
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
