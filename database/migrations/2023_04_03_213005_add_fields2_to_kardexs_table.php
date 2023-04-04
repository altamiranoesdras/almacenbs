<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields2ToKardexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kardexs', function (Blueprint $table) {
            $table->decimal('precio_movimiento','14',4)
                ->after('cantidad')
                ->nullable()
                ->comment("Precio unitario del ingreso o egreso");

            $table->decimal('precio_existencia','14',4)
                ->after('cantidad')
                ->nullable()
                ->comment("Precio unitario del las existencias");
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
