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
            $table->unsignedBigInteger('usuario_solicita_id')->nullable()->after('fecha_aprueba');
            $table->boolean('tiene_firma_solicitante')->nullable()->after('fecha_autoriza');
            $table->boolean('tiene_firma_aprobador')->nullable()->after('tiene_firma_solicitante');
            $table->boolean('tiene_firma_autorizador')->nullable()->after('tiene_firma_aprobador');

            $table->foreign('usuario_solicita_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisiciones', function (Blueprint $table) {
            $table->dropForeign(['usuario_solicita_id']);
            $table->dropColumn('fecha_solicita');
            $table->dropColumn('fecha_aprueba');
            $table->dropColumn('fecha_autoriza');
            $table->dropColumn('usuario_solicita_id');
            $table->dropColumn('tiene_firma_solicitante');
            $table->dropColumn('tiene_firma_aprobador');
            $table->dropColumn('tiene_firma_autorizador');
        });
    }
};
