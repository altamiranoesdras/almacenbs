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
        Schema::table('red_produccion_sub_productos', function (Blueprint $table) {
            $table->foreign(['red_produccion_producto_id'], 'fk_red_produccion_sub_productos_red_produccion_productos1')->references(['id'])->on('red_produccion_productos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('red_produccion_sub_productos', function (Blueprint $table) {
            $table->dropForeign('fk_red_produccion_sub_productos_red_produccion_productos1');
        });
    }
};
