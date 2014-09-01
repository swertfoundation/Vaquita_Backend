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
class VaquitasController extends \BaseController {

	/**
	 * Devuelve la lista de vaquitas del usuario logeado
	 * GET /vaquitas
	 *
	 * @return Json Array
	 */
	public function myList(){
		//
	}

	/**
	 * Recibe valores para crear una nueva vaquita, esta info viene
	 * o se recibe a traves del objto INPUT
	 * PUT /vaquitas/agregar
	 *
	 * @return Json array
	 */
	public function create(){
		//
	}

	/**
	 * Devuelve los datos de una vaquita solicitada
	 * GET /vaquitas/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function show($id){
		//
	}

	/**
	 * Retorna los campos editables para la vaquita solicitada
	 * GET /vaquitas/edit/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function edit($id){
		//
	}

	/**
	 * Recibe los datos de la vaquita que va a ser actualizada
	 * POST /vaquitas/edit/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function update($id){
		//
	}

	/**
	 * Elimina una vaquita especifica solo si el usuario es dueña de ella
	 * DELETE /vaquitas/delete/{id}
	 *
	 * @param  int  $id
	 * @return Json array
	 */
	public function delete($id){
		//
	}

}