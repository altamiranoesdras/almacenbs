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
            $table->date('fecha_solicita')->nullable()->after('justificacion');
            $table->date('fecha_aprueba')->nullable()->after('fecha_solicita');
            $table->date('fecha_autoriza')->nullable()->after('fecha_aprueba');
            $table->boolean('firma_solicitante')->nullable()->after('fecha_autoriza');
            $table->boolean('firma_aprobador')->nullable()->after('firma_solicitante');
            $table->boolean('firma_autorizador')->nullable()->after('firma_aprobador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropColumn('fecha_solicita');
            $table->dropColumn('fecha_aprueba');
            $table->dropColumn('fecha_autoriza');
            $table->dropColumn('firma_solicitante');
            $table->dropColumn('firma_aprobador');
            $table->dropColumn('firma_autorizador');
        });
    }
};
