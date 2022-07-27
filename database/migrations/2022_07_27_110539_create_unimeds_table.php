<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnimedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unimeds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('magnitude_id')->index('fk_unimeds_magnitudes1_idx');
            $table->string('simbolo', 10);
            $table->string('nombre', 45);
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
        Schema::dropIfExists('unimeds');
    }
}
