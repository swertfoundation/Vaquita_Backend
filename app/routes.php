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

Route::group(array('before' => 'auth.firefoxos'), function(){
    //Rutas para realizar acciones sobre amigos
	Route::get('amigos', array('uses' => 'FriendsController@getMyFriends'));
	Route::get('amigos/en-espera', array('uses' => 'FriendsController@waitingConfirmation'));
	Route::get('amigos/confirmar', array('uses' => 'FriendsController@confirmedFriends'));
	Route::put('amigos/agregar/{id}', array('uses' => 'FriendsController@addFriend'));
	Route::delete('amigos/eliminar/{id}', array('uses' => 'FriendsController@deleteFriend'));
	Route::get('amigos/externos/{id}', array('uses' => 'FriendsController@friendsOfMyFirend'));
	Route::get('amigos/perfil/{id}', array('uses' => 'FriendsController@profile'));

});
