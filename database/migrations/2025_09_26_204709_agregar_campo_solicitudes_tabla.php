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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->unsignedBigInteger('envio_fiscal_id')
                ->nullable();

            $table->foreign('envio_fiscal_id', 'fk_compra_1h_envios_fiscales3_idx')
                ->references('id')
                ->on('envios_fiscales')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key first
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign('fk_compra_1h_envios_fiscales3_idx');
            $table->dropColumn('envio_fiscal_id');
        });
    }
};
