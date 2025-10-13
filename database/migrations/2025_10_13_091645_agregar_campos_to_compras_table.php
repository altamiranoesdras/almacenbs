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
            $table->foreignId('usuario_opera_id')
                ->nullable()
                ->after('usuario_crea')
                ->constrained('users')
                ->nullOnDelete();

            //usuario aprobador del formulario 1H
            $table->foreignId('usuario_aprueba_id')
                ->nullable()
                ->after('usuario_opera_id')
                ->constrained('users')
                ->nullOnDelete();

            //usuario autorizador del formulario 1H
            $table->foreignId('usuario_autoriza_id')
                ->nullable()
                ->after('usuario_aprueba_id')
                ->constrained('users')
                ->nullOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['usuario_opera_id']);
            $table->dropColumn('usuario_opera_id');
            $table->dropForeign(['usuario_aprueba_id']);
            $table->dropColumn('usuario_aprueba_id');
            $table->dropForeign(['usuario_autoriza_id']);
            $table->dropColumn('usuario_autoriza_id');
        });
    }
};
