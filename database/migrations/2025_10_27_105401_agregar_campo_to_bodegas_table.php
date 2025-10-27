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
        Schema::table('bodegas', function (Blueprint $table) {
            $table->foreignId('rrhh_unidade_id')
                ->after('id')
                ->nullable()
                ->constrained('rrhh_unidades')
                ->nullOnDelete()
                ->comment('ID de la unidad de recursos humanos asociada a la bodega');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bodegas', function (Blueprint $table) {
            $table->dropForeign(['rrhh_unidade_id']);
            $table->dropColumn('rrhh_unidade_id');
        });
    }
};
