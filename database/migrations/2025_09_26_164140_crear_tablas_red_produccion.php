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
        Schema::create('red_produccion_resultados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('red_produccion_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resultado_id')->constrained('red_produccion_resultados')->onDelete('cascade');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('red_produccion_sub_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('red_produccion_productos')->onDelete('cascade');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        //tabla asociar a red_produccion_resultados -> subprogramas a many to many
        Schema::create('red_produccion_resultado_subprograma', function (Blueprint $table) {
            $table->foreignId('resultado_id')->constrained('red_produccion_resultados')->onDelete('no action');
            $table->foreignId('subprograma_id')->constrained('estructura_presupuestaria_subprogramas')->onDelete('no action');
            $table->primary(['resultado_id', 'subprograma_id']);
        });


        //tabla asociar a red_produccion_productos -> actividades a  many to many
        Schema::create('red_produccion_producto_actividad', function (Blueprint $table) {
            $table->foreignId('producto_id')->constrained('red_produccion_productos')->onDelete('no action');
            $table->foreignId('actividad_id')->constrained('estructura_presupuestaria_actividades')->onDelete('no action');
            $table->primary(['producto_id', 'actividad_id']);
        });

        //tabla para asociar subproductos con rrhh_unidades many to many
        Schema::create('red_produccion_subproducto_rrhh_unidad', function (Blueprint $table) {
            $table->foreignId('subproducto_id')->constrained('red_produccion_sub_productos')->onDelete('no action');
            $table->foreignId('rrhh_unidad_id')->constrained('rrhh_unidades')->onDelete('no action');
            $table->primary(['subproducto_id', 'rrhh_unidad_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //borra llaves foraneas
        Schema::table('red_produccion_productos', function (Blueprint $table) {
            $table->dropForeign(['resultado_id']);
        });
        Schema::table('red_produccion_sub_productos', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
        });

        Schema::table('red_produccion_subproducto_rrhh_unidad', function (Blueprint $table) {
            $table->dropForeign(['subproducto_id']);
            $table->dropForeign(['rrhh_unidad_id']);
        });

        Schema::table('red_produccion_resultado_subprograma', function (Blueprint $table) {
            $table->dropForeign(['resultado_id']);
            $table->dropForeign(['subprograma_id']);
        });

        Schema::table('red_produccion_producto_actividad', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
            $table->dropForeign(['actividad_id']);
        });


        Schema::dropIfExists('red_produccion_sub_productos');
        Schema::dropIfExists('red_produccion_productos');
        Schema::dropIfExists('red_produccion_resultados');
        Schema::dropIfExists('red_produccion_subproducto_rrhh_unidad');
        Schema::dropIfExists('red_produccion_resultado_subprograma');
        Schema::dropIfExists('red_produccion_producto_actividad');

    }
};
