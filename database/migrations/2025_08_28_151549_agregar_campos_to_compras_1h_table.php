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
        Schema::table('compra_1h', function (Blueprint $table) {

            $table->string('justificativa_anulacion', 255)->after('observaciones')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('compra_1h', function (Blueprint $table) {
            $table->dropColumn('justificativa_anulacion');
        });
    }
};
