<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTrasladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_traslados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->integer('correlativo');
            $table->unsignedInteger('item_origen')->index('fk_items_traslados_items1_idx');
            $table->decimal('cantidad_origen', 14)->nullable();
            $table->unsignedInteger('item_destino')->index('fk_items_traslados_items2_idx');
            $table->decimal('cantidad_destino', 14)->nullable();
            $table->text('observaciones')->nullable();
            $table->unsignedInteger('user_id')->index('fk_items_traslados_users1_idx');
            $table->unsignedInteger('estado_id')->index('fk_items_traslados_estados1_idx');
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
        Schema::dropIfExists('items_traslados');
    }
}
