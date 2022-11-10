<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->char('nit', 10)->nullable();
            $table->string('nombre', 45);
            $table->string('razon_social')->nullable()->unique('razon_social_UNIQUE');
            $table->string('correo', 100)->nullable();
            $table->char('telefono_movil', 8)->nullable();
            $table->char('telefono_oficina', 8)->nullable();
            $table->text('direccion')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('proveedores');
    }
}
