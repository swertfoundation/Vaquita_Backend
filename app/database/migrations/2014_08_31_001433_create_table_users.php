<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableUsers extends Migration {

	/**
	 * Migracion encargada de crear la tabla usuarios que contndra los usarios del sistema
	 * de vaquitapp
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('usuarios', function(Blueprint $tabla)
		{
			$tabla->increments('id')->unique()->unsigned();
			$tabla->string('username',60);
			$tabla->string('password',200);
			$tabla->string('email',200);
			$tabla->string('nombre',100);
			$tabla->string('banco',100);
			$tabla->string('tipo_cuenta',100);
			$tabla->string('numero_cuenta',100);
			$tabla->string('facebook',200)->nullable();
			$tabla->string('twitter',200)->nullable();
			$tabla->integer('estado')->unsigned();
			$tabla->string('remember_token');
			$tabla->string('firefoxos_token');
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Se elimina la tabla users.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('usuarios');
	}

}
