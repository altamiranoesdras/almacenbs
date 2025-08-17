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
        Schema::table('compra_ordenes', function (Blueprint $table) {
            $table->foreign(['gestion_id'], 'fk_compra_ordenes_compra_solicitud_gestiones1')->references(['id'])->on('compra_requisiciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['proveedor_id'], 'fk_compra_ordenes_proveedores1')->references(['id'])->on('proveedores')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_ordenes', function (Blueprint $table) {
            $table->dropForeign('fk_compra_ordenes_compra_solicitud_gestiones1');
            $table->dropForeign('fk_compra_ordenes_proveedores1');
        });
    }
};
