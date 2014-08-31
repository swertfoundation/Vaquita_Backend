<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return View::make('hello');
});

Route::get('saludos', function(){
	$datos = array(
		'mensaje' => "olon lolon",
		'codigo'  => 1234
	);

	Event::fire(UpdateScoreEventHandler::EVENT, array($datos));
	return "Oli :3";
});
