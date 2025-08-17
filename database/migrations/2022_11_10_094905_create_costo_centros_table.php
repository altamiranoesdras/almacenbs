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
        Schema::create('costo_centros', function (Blueprint $table) {
            $table->comment('Despacho superior
Subsecretaría de preservación familiar, fortalecimiento y apoyo comunitario
Subsecretaría de reinserción y resocialización de adolescentes en conflicto con la ley penal
Subsecretaría de protección y acogimiento a la niñez y adolescencia

');
            $table->id();

            $table->foreignId('padre_id')
                ->nullable()
                ->constrained('costo_centros')
                ->onDelete('cascade')
                ->index('fk_costo_centros_costo_centros1_idx');

            $table->string('nombre', 45)->nullable();
            $table->string('codigo', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //eliminar foreign key antes de eliminar la tabla
        Schema::table('costo_centros', function (Blueprint $table) {
            $table->dropForeign(['padre_id']);
        });
        Schema::dropIfExists('costo_centros');
    }
};
