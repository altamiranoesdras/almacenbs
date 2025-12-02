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
            $table->string('tiene_firma_analista_presupuesto')
                ->nullable()
                ->after('tiene_firma_autorizador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropColumn('tiene_firma_analista_presupuesto');
        });
    }
};
