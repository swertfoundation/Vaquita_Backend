<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableTagsVaquita extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vaquitas_tags', function(Blueprint $tabla){
			$tabla->integer('tag_id')->unsigned();
			$tabla->integer('vaquita_id')->unsigned();
			$tabla->dateTime('created_at')->default('0000-00-00 00:00:00');
			$tabla->dateTime('updated_at')->default('0000-00-00 00:00:00');

		 	$tabla->foreign('tag_id')->references('id')->on('tags');
		 	$tabla->foreign('vaquita_id')->references('id')->on('vaquita');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('vaquitas_tags');
	}

}
