<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableTags extends Migration {

	/**
	 * Crea la tabla tags que seran agregados por los usuarios al momento de crear
	 * una vaquita
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $tabla){
			$tabla->increments('id')->unique();
			$tabla->string('nombre',50);
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Elimina la tabla tags
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tags');
	}

}
