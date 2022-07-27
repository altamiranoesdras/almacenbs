<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompra1hDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_1h_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('1h_id')->index('fk_compra_1h_detalles_compra_1h1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_compra_1h_detalles_items1_idx');
            $table->decimal('precio', 15, 5);
            $table->decimal('cantidad', 15, 5);
            $table->integer('folio_almacen');
            $table->integer('folio_inventario')->nullable();
            $table->string('codigo_inventario', 50)->nullable();
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
        Schema::dropIfExists('compra_1h_detalles');
    }
}
