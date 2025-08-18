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
        Schema::table('compra_solicitud_has_requisicion', function (Blueprint $table) {
            $table->foreign(['requisicion_id'], 'fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_s1')->references(['id'])->on('compra_requisiciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['solicitud_id'], 'fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_s2')->references(['id'])->on('compra_solicitudes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitud_has_requisicion', function (Blueprint $table) {
            $table->dropForeign('fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_s1');
            $table->dropForeign('fk_compra_solicitud_gestiones_has_compra_solicitudes_compra_s2');
        });
    }
};
