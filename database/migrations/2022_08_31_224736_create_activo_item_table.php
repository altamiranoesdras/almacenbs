<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo_item', function (Blueprint $table) {
            $table->unsignedBigInteger('activo_id')->index('fk_activos_has_items_activos1_idx');
            $table->unsignedBigInteger('item_id')->index('fk_activos_has_items_items1_idx');
            $table->primary(['activo_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activo_item');
    }
}
