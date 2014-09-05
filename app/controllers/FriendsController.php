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
use vaquitapp\Repositories\UsuarioRepo;
use vaquitapp\Managers\UsuarioManager;

class FriendsController extends \BaseController {

	protected $user;
	protected $userManager;

	public function __construct(UsuarioRepo $repository, UsuarioManager $manager){
		$this->user = $repository;
		$this->userManager = $manager;
	}

	/**
	 * Devuelve todos los amigos de cierto usuario logeado
	 * GET /amigos
	 *
	 * @return Json array
	 */
	public function getMyFriends(){
		$friends = $this->user->friends();
		if($friends){
			$response = array(
				'data' => $friends,
				'codigo' => 3401
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 3410
			);
		}
		//return View::make('hello');
		return Response::json( $response );
	}

	/**
	 * Devuelve todos los amigos que estan por confirmar amistad (enviadas)
	 * GET /amigos/en-espera
	 *
	 * @return Json array
	 */
	public function waitingConfirmation(){
		$friends = $this->user->waiting();
		if($friends){
			$response = array(
				'data' => $friends,
				'codigo' => 3401
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 3410
			);
		}
		//return View::make('hello');
		return Response::json( $response );
	}

	/**
	 * Devuelve todos los usuarios que han solicitad amitad y aun
	 * no se aceptan o rechazan (Recibidas)
	 * GET /amigos/confirmar
	 *
	 * @return Json Array
	 */
	public function confirmedFriends(){
		$friends = $this->user->confirm();
		if($friends){
			$response = array(
				'data' => $friends,
				'codigo' => 3401
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 3410
			);
		}
		//return View::make('hello');
		return Response::json( $response );
	}

	/**
	 * Mediante url se envia el id de usuario al cual se le envia
	 * una notificacion de amistad.
	 * PUT /amigos/agregar
	 *
	 * @param  int  $id
	 * @return Json Array
	 */
	public function addFriend($id){
		$status = $this->userManager->addFriend($id);
		if($status['status']){
			$response = array(
				'codigo' => 3406
			);
		}
		else{
			$response = array(
				'codigo' => $status['codigo'],
				'motivo' => $status['motivo']
			);
		}
		//return View::make('hello');
		return Response::json($response);
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
		$status = $this->userManager->deleteFriend($id);
		if($status['status']){
			$response = array(
				'codigo' => 3408
			);
		}
		else{
			$response = array(
				'codigo' => $status['codigo'],
				'motivo' => $status['motivo']
			);
		}
		//return View::make('hello');
		return Response::json($response);
	}

	/**
	 * Ver amigos de otro usuario
	 * GET /amigos/externos/{id}
	 *
	 * @param int id
	 * @return Json Array
	*/
	public function friendsOfMyFirend($id){
		$friends = $this->user->externalFriends($id);
		if($friends){
			$response = array(
				'data' => $friends,
				'codigo' => 3401
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 3410
			);
		}
		//return View::make('hello');
		return Response::json($response);
	}

	/**
	 * Ver perfil de otro usuario
	 * GET /amigos/perfil/{id}
	 *
	 * @param int id
	 * @return Json Array
	*/
	public function profile($id){
		$friends = $this->user->friend($id);
		if($friends){
			$response = array(
				'data' => $friends,
				'codigo' => 3401
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 3410
			);
		}
		//return View::make('hello');
		return Response::json($response);
	}

}