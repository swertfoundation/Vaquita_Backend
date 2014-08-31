<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableAmigos extends Migration {

	/**
	 * Migracion encargada de crear la tabla amigos, que contendra los ids de los usuarios
	 * que tienen estado de amigos
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('amigos', function(Blueprint $tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id')->unsigned();
			$tabla->integer('amigo_id')->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('user_id')->references('id')->on('usuarios');
		 	$tabla->foreign('amigo_id')->references('id')->on('usuarios');
		});
	}


	/**
	 * Borra la tabla amigos si existe
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('amigos');
	}

}
