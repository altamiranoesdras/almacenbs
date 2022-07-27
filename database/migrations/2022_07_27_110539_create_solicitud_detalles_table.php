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
            $table->increments('id');
            $table->unsignedInteger('solicitud_id')->index('fk_solicitud_detalles_solicitudes1_idx');
            $table->unsignedInteger('item_id')->index('fk_solicitud_detalles_items1_idx');
            $table->decimal('cantidad', 12);
            $table->decimal('precio', 12)->nullable();
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
