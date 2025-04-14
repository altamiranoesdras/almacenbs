<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compra_orden_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('compra_ordenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bodega_id')->nullable()->index();
            $table->unsignedBigInteger('proveedor_id')->nullable()->index();
            $table->integer('correlativo')->nullable();
            $table->string('codigo', 10)->nullable();
            $table->date('fecha_requiere')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreignId('estado_id')->index();
            $table->unsignedBigInteger('usuario_solicita')->index();
            $table->unsignedBigInteger('usuario_aprueba')->nullable()->index();
            $table->unsignedBigInteger('usuario_administra')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('estado_id')->references('id')->on('compra_orden_estados');
            $table->foreign('usuario_solicita')->references('id')->on('users');
            $table->foreign('usuario_aprueba')->references('id')->on('users');
            $table->foreign('usuario_administra')->references('id')->on('users');
        });

        Schema::create('compra_orden_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id')->index();
            $table->unsignedBigInteger('item_id')->index();
            $table->integer('cantidad');
            $table->decimal('precio_venta', 14, 2);
            $table->decimal('precio_compra', 14, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('orden_id')->references('id')->on('compra_ordenes');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //eliminar llaves foraneas
        Schema::table('compra_ordenes', function (Blueprint $table) {
            $table->dropForeign(['bodega_id','proveedor_id','estado_id','usuario_solicita','usuario_aprueba','usuario_administra']);

        });

        Schema::table('compra_orden_detalles', function (Blueprint $table) {
            $table->dropForeign(['orden_id','item_id']);
        });

        //eliminar tablas
        Schema::dropIfExists('compra_orden_detalles');
        Schema::dropIfExists('compra_ordenes');
        Schema::dropIfExists('compra_orden_estados');
    }
};
