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
        Schema::table('red_produccion_resultados', function (Blueprint $table) {
            //foranea de estructura_presupuestaria_subprogramas
            $table->foreignId('subprograma_id')
                ->nullable()
                ->constrained('estructura_presupuestaria_subprogramas')
                ->nullOnDelete();

        });

        Schema::table('red_produccion_productos', function (Blueprint $table) {
            //foranea de estructura_presupuestaria_subprogramas
            $table->foreignId('actividad_id')
                ->nullable()
                ->constrained('estructura_presupuestaria_actividades')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('red_produccion_resultados', function (Blueprint $table) {
            $table->dropForeign(['subprograma_id']);
            $table->dropColumn('subprograma_id');
        });

        Schema::table('red_produccion_productos', function (Blueprint $table) {
            $table->dropForeign(['actividad_id']);
            $table->dropColumn('actividad_id');
        });
    }
};
