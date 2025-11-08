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
        Schema::table('compra_solicitud_detalles', function (Blueprint $table) {

            //red prodcucción sub_producto_id
            $table->foreignId('sub_producto_id')
                ->nullable()
                ->after('precio_estimado')
                ->constrained('red_produccion_sub_productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_solicitud_detalles', function (Blueprint $table) {
            $table->dropForeign(['sub_producto_id']);
            $table->dropColumn('sub_producto_id');
        });
    }
};
