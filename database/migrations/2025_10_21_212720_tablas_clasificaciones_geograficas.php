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
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->foreignId('region_id')
                ->nullable()
                ->constrained('regiones')
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->foreignId('departamento_id')
                ->nullable()
                ->constrained('departamentos')
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipios', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
        });
        Schema::dropIfExists('municipios');
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
        });
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('regiones');
    }
};
