<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableVaquitaNotificaciones extends Migration {

	/**
	 * Migracion que crea la tabla vaquita_notificaciones que contiene todas las
	 * notificaciones realizadas por la vaquita.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vaquita_notificaciones', function(Blueprint $tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id')->unsigned();
			$tabla->integer('vaquita_id')->unsigned();
			$tabla->integer('notificacion_id')->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('user_id')->references('id')->on('usuarios');
		 	$tabla->foreign('vaquita_id')->references('id')->on('vaquita');
		 	$tabla->foreign('notificacion_id')->references('id')->on('notificaciones');
		});
	}


	/**
	 * Elimina la tabla vaquita_notificaiones
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('vaquita_notificaciones');
	}

}
