<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumo_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumo_id')->index('fk_consumo_detalles_consumos1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_consumo_detalles_items1_idx');
            $table->decimal('cantidad', 12, 0);
            $table->decimal('precio', 12, 0)->nullable();
            $table->date('fecha_vence')->nullable();
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
        Schema::dropIfExists('consumo_detalles');
    }
}
