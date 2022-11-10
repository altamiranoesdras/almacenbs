<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUnimedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unimeds', function (Blueprint $table) {
            $table->foreign('magnitud_id', 'fk_unimeds_magnitudes1')->references('id')->on('magnitudes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unimeds', function (Blueprint $table) {
            $table->dropForeign('fk_unimeds_magnitudes1');
        });
    }
}
