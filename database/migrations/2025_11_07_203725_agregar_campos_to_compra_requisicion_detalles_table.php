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
        Schema::table('compra_requisicion_detalles', function (Blueprint $table) {
            //red prodcucción sub_producto_id
            $table->foreignId('sub_producto_id')
                ->after('precio_estimado')
                ->nullable()
                ->constrained('red_produccion_sub_productos');

            $table->foreignId('financiamiento_fuente_id')
                ->after('sub_producto_id')
                ->nullable()
                ->constrained('financiamiento_fuentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_requisicion_detalles', function (Blueprint $table) {
            $table->dropForeign(['sub_producto_id']);
            $table->dropColumn('sub_producto_id');
            $table->dropForeign(['financiamiento_fuente_id']);
            $table->dropColumn('financiamiento_fuente_id');
        });
    }
};
