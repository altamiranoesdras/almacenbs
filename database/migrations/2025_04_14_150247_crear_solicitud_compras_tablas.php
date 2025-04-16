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
        Schema::create('compra_solicitud_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('compra_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bodega_id')->nullable()->index();
            $table->unsignedBigInteger('proveedor_id')->nullable()->index();
            $table->unsignedBigInteger('unidad_id')->nullable()->index();
            $table->integer('correlativo')->nullable();
            $table->string('codigo', 10)->nullable();
            $table->date('fecha_requiere')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreignId('estado_id')->index();
            $table->unsignedBigInteger('usuario_solicita')->index();
            $table->unsignedBigInteger('usuario_aprueba')->nullable()->index();
            $table->unsignedBigInteger('usuario_administra')->nullable()->index();
            $table->string('subproductos')->nullable();
            $table->string('partidas')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('unidad_id')->references('id')->on('rrhh_unidades');
            $table->foreign('estado_id')->references('id')->on('compra_solicitud_estados');
            $table->foreign('usuario_solicita')->references('id')->on('users');
            $table->foreign('usuario_aprueba')->references('id')->on('users');
            $table->foreign('usuario_administra')->references('id')->on('users');
        });

        Schema::create('compra_solicitud_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->index();
            $table->unsignedBigInteger('item_id')->index();
            $table->integer('cantidad');
            $table->decimal('precio_venta', 14, 2);
            $table->decimal('precio_compra', 14, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('solicitud_id')->references('id')->on('compra_solicitudes');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //eliminar llaves foraneas
        Schema::table('compra_solicitudes', function (Blueprint $table) {
            $table->dropForeign(['bodega_id']);
            $table->dropForeign(['proveedor_id']);
            $table->dropForeign(['unidad_id']);
            $table->dropForeign(['estado_id']);
            $table->dropForeign(['usuario_solicita']);
            $table->dropForeign(['usuario_aprueba']);
            $table->dropForeign(['usuario_administra']);


        });

        Schema::table('compra_solicitud_detalles', function (Blueprint $table) {
            $table->dropForeign(['solicitud_id']);
            $table->dropForeign(['item_id']);
        });

        //eliminar tablas
        Schema::dropIfExists('compra_solicitud_detalles');
        Schema::dropIfExists('compra_solicitudes');
        Schema::dropIfExists('compra_solicitud_estados');
    }
};
