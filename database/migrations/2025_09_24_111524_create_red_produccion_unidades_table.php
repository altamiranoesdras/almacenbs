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
        Schema::create('red_produccion_unidades', function (Blueprint $table) {
            $table->unsignedInteger('red_produccion_sub_productos_id')->index('fk_red_produccion_sub_productos_has_rrhh_unidades_red_produ_idx');
            $table->unsignedBigInteger('rrhh_unidades_id')->index('fk_red_produccion_sub_productos_has_rrhh_unidades_rrhh_unid_idx');

            $table->primary(['red_produccion_sub_productos_id', 'rrhh_unidades_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('red_produccion_unidades');
    }
};
