<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_imports', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->integer('cantidad_registros');
            $table->integer('cantidad_importados');
            $table->integer('fallos');
            $table->foreignId('usuario_carga')->constrained('users');
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

        Schema::dropIfExists('item_imports');
    }
}
