<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->index('fk_solicitud_detalles_solicitudes1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_solicitud_detalles_items1_idx');
            $table->decimal('cantidad_solicitada', 12);
            $table->decimal('cantidad_despachada', 12)->default(0);
            $table->decimal('precio', 12)->nullable();
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
        Schema::dropIfExists('solicitud_detalles');
    }
}
