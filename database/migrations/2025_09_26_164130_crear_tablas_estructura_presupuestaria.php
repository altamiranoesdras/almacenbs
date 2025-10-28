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
        //Programas -> Sub_programas -> Proyectos -> Actividades
        Schema::create('estructura_presupuestaria_programas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('estructura_presupuestaria_subprogramas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programa_id')->constrained('estructura_presupuestaria_programas')->onDelete('cascade');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('estructura_presupuestaria_proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subprograma_id')->constrained('estructura_presupuestaria_subprogramas')->onDelete('cascade');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('estructura_presupuestaria_actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('estructura_presupuestaria_proyectos')->onDelete('cascade');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //borra llaves foraneas
        Schema::table('estructura_presupuestaria_subprogramas', function (Blueprint $table) {
            $table->dropForeign(['programa_id']);
        });
        Schema::table('estructura_presupuestaria_proyectos', function (Blueprint $table) {
            $table->dropForeign(['subprograma_id']);
        });
        Schema::table('estructura_presupuestaria_actividades', function (Blueprint $table) {
            $table->dropForeign(['proyecto_id']);
        });

        Schema::dropIfExists('estructura_presupuestaria_actividades');
        Schema::dropIfExists('estructura_presupuestaria_proyectos');
        Schema::dropIfExists('estructura_presupuestaria_subprogramas');
        Schema::dropIfExists('estructura_presupuestaria_programas');
    }
};
