<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableUsuariosVaquita extends Migration {

	/**
	 * Migracion encargada de crear la tabla usuarios_vaquita, que contendra a los integrantes
	 * invitados a participar en la creacion de la vaquita
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('usuarios_vaquita', function(Blueprint $tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id')->unsigned();
			$tabla->integer('vaquita_id')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('user_id')->references('id')->on('usuarios');
		 	$tabla->foreign('vaquita_id')->references('id')->on('vaquita');
		});
	}


	/**
	 * Elimina la tabla usuarios_vaquita
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('usuarios_vaquita');
	}

}
