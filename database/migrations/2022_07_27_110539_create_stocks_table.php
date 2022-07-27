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
            $table->unsignedBigInteger('item_id')->index('fk_igresos_items1_idx');
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
