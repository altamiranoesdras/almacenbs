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
        Schema::table('rrhh_unidades', function (Blueprint $table) {
            $table->foreignId('departamento_id')->after('jefe_id')
                ->nullable()
                ->constrained('departamentos')
                ->nullOnDelete();
            $table->foreignId('municipio_id')->after('departamento_id')
                ->nullable()
                ->constrained('municipios')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rrhh_unidades', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->dropColumn('departamento_id');
            $table->dropForeign(['municipio_id']);
            $table->dropColumn('municipio_id');
        });
    }
};
