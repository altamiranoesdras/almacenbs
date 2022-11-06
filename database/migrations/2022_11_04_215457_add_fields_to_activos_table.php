<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->integer('entidad')->after('fecha_registra')->nullable();
            $table->integer('unidad_ejecutadora')->after('entidad')->nullable();
            $table->unsignedBigInteger('renglon_id')->after('estado_id')->nullable()->index('fk_activos_renglones1_idx');
            $table->integer('tipo_inventario')->after('unidad_ejecutadora')->nullable();
            $table->string('numero_bien')->after('tipo_inventario')->nullable();
            $table->integer('valor_actual')->after('numero_bien')->nullable();
            $table->integer('valor_adquisicion')->after('valor_actual')->nullable();
            $table->integer('valor_contabilizado')->after('valor_adquisicion')->nullable();
            $table->integer('codigo_donacion')->after('valor_contabilizado')->nullable();
            $table->string('nit')->after('codigo_donacion')->nullable();
            $table->integer('numero_documento')->after('codigo_donacion')->nullable();
            $table->date('fecha_registro')->after('numero_documento')->nullable();
            $table->date('fecha_aprobado')->after('fecha_registro')->nullable();
            $table->date('fecha_contabilizacion')->after('fecha_aprobado')->nullable();
            $table->string('cur')->after('fecha_contabilizacion')->nullable();
            $table->string('contabilizado')->after('cur')->nullable();
            $table->integer('diferencia_act_adq')->after('contabilizado')->nullable();
            $table->integer('diferencia_act_cont')->after('diferencia_act_adq')->nullable();
            $table->integer('diferencia_adq_cont')->after('diferencia_act_cont')->nullable();
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

        });
    }
}
