<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->index('fk_stock_items1_idx');

            $table->foreignId('unidad_id')
                ->nullable()
                ->comment('sirve para saber el stock que la unidad tiene como limite para poder requerir')
                ->constrained('rrhh_unidades');

            $table->unsignedBigInteger('bodega_id')->nullable()->index('fk_stock_bodegas1_idx')
                ->comment('despues que la unidad haga el requerimiento, se traslada a la bodega de la unidad');
            $table->string('lote', 25)->nullable();
            $table->timestamp('fecha_ing')->useCurrent();
            $table->date('fecha_vence')->nullable();
            $table->decimal('precio_compra', 14)->default(0.00);
            $table->decimal('cantidad', 12);
            $table->decimal('cantidad_inicial', 12);
            $table->unsignedTinyInteger('orden_salida')->default(0);
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
        Schema::dropIfExists('stocks');
    }
}
