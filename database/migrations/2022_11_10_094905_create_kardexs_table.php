<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->index('fk_kardexs_items1_idx');
            $table->integer('model_id');
            $table->string('model_type');
            $table->integer('folio')->nullable();
            $table->decimal('cantidad', 14);
            $table->enum('tipo', ['ingreso', 'salida']);
            $table->string('codigo')->nullable();
            $table->string('responsable')->nullable();
            $table->text('observacion')->nullable();
            $table->tinyInteger('impreso')->nullable()->default(0);
            $table->unsignedBigInteger('usuario_id')->index('fk_kardexs_users1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardexs');
    }
}
