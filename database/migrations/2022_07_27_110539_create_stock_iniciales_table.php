<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInicialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_iniciales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->index('fk_inistocks_items1_idx');
            $table->decimal('cantidad', 12, 4);
            $table->unsignedInteger('user_id')->index('fk_inistocks_users1_idx');
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
        Schema::dropIfExists('stock_iniciales');
    }
}
