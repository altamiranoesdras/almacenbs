<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquivalenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equivalencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_origen')->index('fk_equivalencias_items1_idx');
            $table->unsignedBigInteger('item_destino')->index('fk_equivalencias_items2_idx');
            $table->decimal('cantidad', 12);
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
        Schema::dropIfExists('equivalencias');
    }
}
