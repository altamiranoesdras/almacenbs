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
        Schema::table('red_produccion_productos', function (Blueprint $table) {
            $table->foreign(['red_produccion_proyecto_id'], 'fk_red_produccion_productos_red_produccion_proyectos1')->references(['id'])->on('red_produccion_proyectos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('red_produccion_productos', function (Blueprint $table) {
            $table->dropForeign('fk_red_produccion_productos_red_produccion_proyectos1');
        });
    }
};
