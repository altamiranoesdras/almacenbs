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
        Schema::table('red_produccion_unidades', function (Blueprint $table) {
            $table->foreign(['red_produccion_sub_productos_id'], 'fk_red_produccion_sub_productos_has_rrhh_unidades_red_producc1')->references(['id'])->on('red_produccion_sub_productos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['rrhh_unidades_id'], 'fk_red_produccion_sub_productos_has_rrhh_unidades_rrhh_unidad1')->references(['id'])->on('rrhh_unidades')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('red_produccion_unidades', function (Blueprint $table) {
            $table->dropForeign('fk_red_produccion_sub_productos_has_rrhh_unidades_red_producc1');
            $table->dropForeign('fk_red_produccion_sub_productos_has_rrhh_unidades_rrhh_unidad1');
        });
    }
};
