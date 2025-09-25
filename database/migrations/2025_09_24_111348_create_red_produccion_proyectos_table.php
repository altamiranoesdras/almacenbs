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
        Schema::create('red_produccion_proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('red_produccion_sub_programa_id')->index('fk_red_produccion_proyectos_red_produccion_sub_programas1_idx');
            $table->string('codigo', 4);
            $table->string('nombre', 500);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('red_produccion_proyectos');
    }
};
