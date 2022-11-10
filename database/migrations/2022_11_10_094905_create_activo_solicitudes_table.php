<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colaborador_origen')->index('fk_activo_solicitudes_rrhh_colaboradores1_idx');
            $table->unsignedBigInteger('unidad_origen')->index('fk_activo_solicitudes_rrhh_unidades1_idx');
            $table->unsignedBigInteger('colaborador_destino')->index('fk_activo_solicitudes_rrhh_colaboradores2_idx');
            $table->unsignedBigInteger('unidad_destino')->index('fk_activo_solicitudes_rrhh_unidades2_idx');
            $table->string('codigo', 45)->nullable();
            $table->integer('correlativo')->nullable();
            $table->unsignedBigInteger('usuario_autoriza')->nullable()->index('fk_activo_solicitudes_users3_idx');
            $table->unsignedBigInteger('usuario_inventario')->nullable()->index('fk_activo_solicitudes_users4_idx');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('estado_id')->index('fk_activo_solicitudes_activo_solicitud_estados1_idx');
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
        Schema::dropIfExists('activo_solicitudes');
    }
}
