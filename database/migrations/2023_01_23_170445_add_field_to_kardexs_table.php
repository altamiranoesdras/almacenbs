<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToKardexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kardexs', function (Blueprint $table) {
            $table->string('codigo_insumo')->nullable()->after('folio');
            $table->date('del')->nullable()->after('folio');
            $table->date('al')->nullable()->after('folio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kardexs', function (Blueprint $table) {
            //
        });
    }
}
