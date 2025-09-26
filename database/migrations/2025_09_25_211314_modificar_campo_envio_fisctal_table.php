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
        Schema::table('envios_fiscales', function (Blueprint $table) {
            $table->renameColumn('nuemero_constancia', 'numero_constancia');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('envios_fiscales', function (Blueprint $table) {
            $table->renameColumn('numero_constancia', 'nuemero_constancia');
        });
    }
};
