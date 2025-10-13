<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('solicitud_detalles', function (Blueprint $table) {
            $table->decimal('cantidad_autorizada', 12)
                ->after('cantidad_aprobada')
                ->default(0)
                ->comment('Cantidad autorizada por el autorizador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitud_detalles', function (Blueprint $table) {
            $table->dropColumn('cantidad_autorizada');
        });
    }
};
