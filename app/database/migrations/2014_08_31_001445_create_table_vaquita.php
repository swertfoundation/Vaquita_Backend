<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableVaquita extends Migration {

	/**
	 * Migracion encargada de crear la tabla vaquitas, que contendra todas las campañas
	 * para juntar el dinero segun meta
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('vaquita', function(Blueprint $tabla){
			$tabla->increments('id')->unique()->unsigned();
			$tabla->integer('admin')->unsigned();
			$tabla->string('nombre',100);
			$tabla->text('descripcion');
			$tabla->integer('meta')->unsigned();
			$tabla->integer('actual')->unsigned();
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('finish_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('admin')->references('id')->on('usuarios');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('vaquita');
	}

}
