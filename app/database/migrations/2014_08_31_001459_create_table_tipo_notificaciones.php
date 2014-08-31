<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableTipoNotificaciones extends Migration {

	/**
	 * Esta migracion crea la tabla notificaciones, esta contendra los tipos de notificaciones
	 * que se generan por cada vaquita, ejemplo, vaca flacas, se llego a la meta, etc
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('notificaciones', function(Blueprint $tabla){
			$tabla->increments('id')->unique()->unsigned();
			$tabla->string('nombre',100);
			$tabla->string('icono',100);
			$tabla->integer('estado')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('notificaciones');
	}

}
