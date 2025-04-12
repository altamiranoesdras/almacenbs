<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBitacorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bitacoras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('model_type');
			$table->bigInteger('model_id')->unsigned();
			$table->string('seccion')->nullable();
			$table->string('titulo');
			$table->text('comentario', 65535);
			$table->integer('usuario_id')->unsigned()->index('fk_bitacoras_users1_idx');
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
		Schema::drop('bitacoras');
	}

}
