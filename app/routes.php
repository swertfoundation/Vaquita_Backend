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
use vaquitapp\Entities\Usuario;

Route::get('/', function(){
	return View::make('hello');
});
Route::post('login', array('uses' => 'AuthController@doLogin'));

//Rutas para crear un perfil
Route::put('cuenta', array('uses' => 'ProfileController@create'));

Route::group(array('before' => 'auth.firefoxos'), function(){
    
    //Rutas para realizar acciones sobre amigos
	Route::get('amigos', array('uses' => 'FriendsController@getMyFriends'));
	Route::get('amigos/en-espera', array('uses' => 'FriendsController@waitingConfirmation'));
	Route::get('amigos/confirmar', array('uses' => 'FriendsController@confirmedFriends'));
	Route::put('amigos/agregar/{id}', array('uses' => 'FriendsController@addFriend'));
	Route::delete('amigos/eliminar/{id}', array('uses' => 'FriendsController@deleteFriend'));
	Route::get('amigos/externos/{id}', array('uses' => 'FriendsController@friendsOfMyFirend'));
	Route::get('amigos/perfil/{id}', array('uses' => 'FriendsController@profile'));

	//Rutas para realizar accines sobre las vaquitas
	Route::get('vaquitas', array('uses' => 'VaquitasController@myList'));
	Route::get('vaquitas/{id}', array('uses' => 'VaquitasController@show'));
	Route::get('vaquitas/editar/{id}', array('uses' => 'VaquitasController@edit'));
	Route::post('vaquitas/actualizar', array('uses' => 'VaquitasController@update'));
	Route::put('vaquitas/crear', array('uses' => 'VaquitasController@create'));
	Route::put('vaquitas/suscribir/{id}', array('uses' => 'VaquitasController@addToVaquita'));
	Route::delete('vaquitas/desuscribirme/{id}', array('uses' => 'VaquitasController@deleteToVaquita'));
	Route::delete('vaquitas/eliminar/{id}', array('uses' => 'VaquitasController@delete'));

	//Rutas para realizar acciones sobre el perfil
	Route::get('perfil', array('uses' => 'ProfileController@getProfile') );
	Route::post('perfil/actualizar', array('uses' => 'ProfileController@update') );
	Route::delete('perfil', array('uses' => 'ProfileController@deleteProfile') );

});
