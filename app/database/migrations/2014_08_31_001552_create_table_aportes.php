<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableAportes extends Migration {

	/**
	 * Migracion de la tabla aportes que contendra los ids de los usuarios que han 
	 * colaborado en cierta vaquita, mas un estado que define si el monto fue
	 * depositad en alguna cuenta bancaria del admin de la vaquita
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aporte', function(Blueprint $tabla){
			$tabla->increments('id')->unique();
			$tabla->integer('user_id')->unsigned();
			$tabla->integer('vaquita_id')->unsigned();
			$tabla->integer('monto')->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('user_id')->references('id')->on('usuarios');
		 	$tabla->foreign('vaquita_id')->references('id')->on('vaquita');
		});
	}


	/**
	 * Elimina la tabla aportes
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('aporte');
	}

}
