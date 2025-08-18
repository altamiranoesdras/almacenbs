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
            $table->foreign(['estado_id'])->references(['id'])->on('compra_solicitud_estados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['unidad_id'])->references(['id'])->on('rrhh_unidades')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['usuario_verifica'], 'compra_solicitudes_usuario_administra_foreign')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['usuario_solicita'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitudes', function (Blueprint $table) {
            $table->dropForeign('compra_solicitudes_estado_id_foreign');
            $table->dropForeign('compra_solicitudes_unidad_id_foreign');
            $table->dropForeign('compra_solicitudes_usuario_administra_foreign');
            $table->dropForeign('compra_solicitudes_usuario_solicita_foreign');
        });
    }
};
