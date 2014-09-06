<?php
/*
|--------------------------------------------------------------------------
| VaquitasController
|--------------------------------------------------------------------------
|
| Controlador encargado de gestionar las vaquitas de un usuario
| como lo son: agregar. eliminar, obtener lista, entre otros
|
*/
use vaquitapp\Repositories\VaquitaRepo;
use vaquitapp\Managers\VaquitaManager;

class VaquitasController extends \BaseController {

	protected $repo;
	protected $manager;

	public function __construct(VaquitaRepo $repo,VaquitaManager $manager){
		$this->repo = $repo;
		$this->manager = $manager;
	}

	/**
	 * Devuelve la lista de vaquitas del usuario logeado
	 * GET /vaquitas
	 *
	 * @return Json Array
	 */
	public function myList(){
		$vaquitas = $this->repo->vaquitas();
		$suscrito = $this->repo->suscrito();

		if($suscrito || $vaquitas){
			$response = array(
				'misVaquitas' => (is_array($vaquitas)) ? $vaquitas : array(),
				'suscrito' => (is_array($suscrito)) ? $suscrito : array(),
				'codigo' => 4201
			);
		}
		else{
			$response = array(
				'misVaquitas' => array(),
				'suscrito' => array(),
				'codigo' => 4209
			);
		}
		return Response::json( $response );
	}

	/**
	 * Recibe valores para crear una nueva vaquita, esta info viene
	 * o se recibe a traves del objto INPUT
	 * PUT /vaquitas/crear
	 *
	 * @return Json array
	 */
	public function create(){
		$status = $this->manager->create();
		if($status['status']){
			$response = array(
				'codigo' => 4205
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
	 * Devuelve los datos de una vaquita solicitada
	 * GET /vaquitas/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function show($id){
		$vaquita = $this->repo->show($id);
		if($vaquita){
			$response = array(
				'data' => $vaquita,
				'codigo' => 4201
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 4209
			);
		}
		//return View::make('hello');
		return Response::json($response);
	}

	/**
	 * Retorna los campos editables para la vaquita solicitada
	 * GET /vaquitas/editar/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function edit($id){
		$vaquita = $this->repo->show($id);
		if($vaquita){
			$response = array(
				'data' => $vaquita,
				'codigo' => 4201
			);
		}
		else{
			$response = array(
				'data' => array(),
				'codigo' => 4209
			);
		}
		//return View::make('hello');
		return Response::json($response);
	}

	/**
	 * Recibe los datos de la vaquita que va a ser actualizada
	 * POST /vaquitas/actualizar
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function update(){
		$status = $this->manager->update();
		if($status['status']){
			$response = array(
				'codigo' => 4210
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
	 * Elimina una vaquita especifica solo si el usuario es dueña de ella
	 * DELETE /vaquitas/delete/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function delete($id){
		return array(
			'codigo' => 000,
			'motivo' => "Proceso en mantenimiento"
		);
	}

	/**
	 * Se recibe un ID de vaquita y se suscribe/agrega al usuario actual
	 * de la vaquta
	 * PUT /vaquitas/suscribir/{id}
	 *
	 * @param int $id
	 * @return Json array
	*/
	public function addToVaquita($id){
		$status = $this->manager->addMeToVaquita($id);
		if($status['status']){
			$response = array(
				'codigo' => 4212
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
	 * Se recibe un ID de vaquita y se desuscribe/elimina al usuario actual
	 * de la vaquita
	 * DELETE /vaquitas/desuscribir/{id}
	 *
	 * @param int $id
	 * @return Json array
	*/
	public function deleteToVaquita($id){
		$status = $this->manager->deleteMeToVaquita($id);
		if($status['status']){
			$response = array(
				'codigo' => 4212
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

}