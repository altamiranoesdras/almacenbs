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
        Schema::create('financiamiento_fuentes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_fuente')->unique();
            $table->string('codigo_organismo')->nullable();
            $table->string('correlativo')->nullable();
            $table->string('nombre')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financiamiento_fuentes');
    }
};
