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
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_proceso_id')
                ->nullable()
                ->after('tipo_concurso_id');

            $table->foreign('tipo_proceso_id')
                ->references('id')
                ->on('compra_requisicion_proceso_tipos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropForeign(['tipo_proceso_id']);
            $table->dropColumn('tipo_proceso_id');
        });
    }
};
