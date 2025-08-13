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
        Schema::table('compra_solicitudes', function (Blueprint $table) {
            $table->dateTime('fecha_solicita')->nullable()->after('fecha_requiere');
            $table->dateTime('fecha_aprueba')->nullable()->after('fecha_solicita');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitudes', function (Blueprint $table) {
            $table->dropColumn('fecha_solicita');
            $table->dropColumn('fecha_aprueba');
        });
    }
};
