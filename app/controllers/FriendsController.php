<?php
/*
|--------------------------------------------------------------------------
| FriendsController
|--------------------------------------------------------------------------
|
| Controlador encargado de gestionar la lista de amigos de un usuario
| como lo son: agregar. eliminar, obtener lista de amigos, entre otros
|
*/
class FriendsController extends \BaseController {

	/**
	 * Devuelve todos los amigos de cierto usuario logeado
	 * GET /amigos
	 *
	 * @return Json array
	 */
	public function getMyFriends(){
		//
	}

	/**
	 * Devuelve todos los amigos que estan por confirmar amista
	 * GET /amigos/en-espera
	 *
	 * @return Json array
	 */
	public function waitingConfirmation(){
		//
	}

	/**
	 * Dvuelve todos los usuarios que han solicitad amitad y aun
	 * no se aceptan o rechazan
	 * GET /amigos/confirmar
	 *
	 * @return Json Array
	 */
	public function confirmedFriends(){
		//
	}

	/**
	 * Mediante url se envia el id de usuario al cual se le envia
	 * una notificacion de amistad.
	 * PUT /amigos/agregar/{id}
	 *
	 * @param  int  $id
	 * @return Json Array
	 */
	public function addFriend($id){
		//
	}

	/**
	 * Mediante url se recibe un id de amigo que se desea eliminar
	 * la amistad
	 * DELETE /amigos/eliminar/{id}
	 *
	 * @param  int  $id
	 * @return Json Array
	 */
	public function deleteFriend($id){
		//
	}

}