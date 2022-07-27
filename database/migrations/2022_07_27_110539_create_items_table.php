<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 25)->nullable()->unique('codigo_UNIQUE');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('renglon_id')->index('fk_items_renglones1_idx');
            $table->unsignedInteger('marca_id')->nullable()->index('fk_items_marcas1_idx');
            $table->unsignedInteger('unimed_id')->nullable()->index('fk_items_unimeds1_idx');
            $table->unsignedInteger('categoria_id')->nullable()->index('fk_items_icategorias1_idx');
            $table->decimal('precio_venta', 12)->nullable();
            $table->decimal('precio_compra', 12)->default(0.00);
            $table->decimal('precio_promedio', 12)->default(0.00);
            $table->decimal('stock_minimo', 14, 6)->nullable();
            $table->decimal('stock_maximo', 14, 6)->nullable();
            $table->string('ubicacion', 45)->nullable();
            $table->boolean('perecedero')->nullable()->default(0);
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
        Schema::dropIfExists('items');
    }
}
