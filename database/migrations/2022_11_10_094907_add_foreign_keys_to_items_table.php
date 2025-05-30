<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('renglon_id', 'fk_items_renglones1')->references('id')->on('renglones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('categoria_id', 'fk_items_icategorias1')->references('id')->on('item_categorias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('marca_id', 'fk_items_marcas1')->references('id')->on('marcas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('unimed_id', 'fk_items_unimeds1')->references('id')->on('unimeds')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tipo_id', 'fk_items_item_tipos1')->references('id')->on('item_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('presentacion_id', 'fk_items_item_presentaciones1')->references('id')->on('item_presentaciones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('modelo_id', 'fk_items_item_modelos1')->references('id')->on('item_modelos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('fk_items_renglones1');
            $table->dropForeign('fk_items_icategorias1');
            $table->dropForeign('fk_items_marcas1');
            $table->dropForeign('fk_items_unimeds1');
            $table->dropForeign('fk_items_item_tipos1');
            $table->dropForeign('fk_items_item_presentaciones1');
            $table->dropForeign('fk_items_item_modelos1');
        });
    }
}
