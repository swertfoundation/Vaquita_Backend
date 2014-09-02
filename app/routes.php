<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Todas las rutas de la api se encargan de retornar un JSON de informacion
| ya sea si no esta logeado, respuestas para modelos de backboneJS, etc.
|
*/

Route::get('/', function(){
	return View::make('hello');
});
Route::get('login', array('uses' => 'AuthController@errorLogin'));
Route::post('login', array('uses' => 'AuthController@doLogin'));

Route::post('status', function(){
	if (Auth::check()){
		$response = array(
			'status' => true
		);
	}
	else{
		$response = array(
			'status' => false
		);
	}

	return Response::json($response, 200);
});

Route::group(array('before' => 'auth'), function(){

    Route::get('saludos', function(){
		$datos = array(
			'mensaje' => "olon lolon",
			'codigo'  => 1234
		);

		//Event::fire(UpdateScoreEventHandler::EVENT, array($datos));
		return "Oli :3";
	});

    Route::get('logout', 'AuthController@logOut');

    //Rutas para realizar acciones sobre amigos
	Route::get('amigos', array('uses' => 'FriendsController@getMyFriends'));
	Route::get('amigos/en-espera', array('uses' => 'FriendsController@waitingConfirmation'));
	Route::get('amigos/confirmar', array('uses' => 'FriendsController@confirmedFriends'));
	Route::get('amigos/agregar/{id}', array('uses' => 'FriendsController@addFriend'));
	Route::get('amigos/eliminar/{id}', array('uses' => 'FriendsController@deleteFriend'));

});
