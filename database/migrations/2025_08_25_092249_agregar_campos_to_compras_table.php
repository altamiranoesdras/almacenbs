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
        Schema::table('compras', function (Blueprint $table) {

            $table->foreignId('unidad_solicita_id')->after('correlativo')->nullable()->constrained('rrhh_unidades');

        });



        Schema::table('compra_detalles', function (Blueprint $table) {

            $table->foreignId('unidad_solicita_id')->after('compra_id')->nullable()->constrained('rrhh_unidades');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['unidad_solicita_id']);
            $table->dropColumn('unidad_solicita_id');
        });

        Schema::table('compra_detalles', function (Blueprint $table) {
            $table->dropForeign(['unidad_solicita_id']);
            $table->dropColumn('unidad_solicita_id');
        });
    }
};
