<?php namespace vaquitapp\Managers;

use vaquitapp\Entities\Usuario;
use vaquitapp\Entities\Vaquita;
use vaquitapp\Entities\Integrante;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class VaquitaManager{

	public function create(){
		$yo = Usuario::where('username','=',Input::get('username'))->get();
		$validations = Validator::make(
			array(
				'nombre' => Input::get('nombre'),
				'meta' => (int)Input::get('meta'),
				'finializa' => Input::get('finaliza'),
				'descripcion' => Input::get('descripcion')
			),
			array(
				'nombre' => 'required|max:100',
				'meta' => 'required|numeric',
				'finializa' => 'required',
				'descripcion' => 'required'
			)
		);

		if(!$validations->fails()){
			try{
				$vaca = new Vaquita();
				$vaca->nombre = Input::get('nombre');
				$vaca->descripcion = Input::get('descripcion');
				$vaca->meta = Input::get('meta');
				$vaca->finish_at = Input::get('finaliza');
				$vaca->admin = $yo[0]->id;
				$vaca->save();

				return array(
					'codigo' => 4205,
					'status' => true
				);
			}
			catch( QueryException $e){
				print_r($e);
				return array(
					'codigo' => 4206,
					'motivo' => 'Se genero un problema al tratar de crear la vaca, intenta más tarde',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 4206,
				'motivo' => 'La vaquita se encuentra con errores de validacion',
				'status' => false
			);
		}
	}

	public function update(){
		$yo = Usuario::where('username','=',Input::get('username'))->get();
		$validations = Validator::make(
			array(
				'nombre' => Input::get('nombre'),
				'meta' => (int)Input::get('meta'),
				'finializa' => Input::get('finaliza'),
				'descripcion' => Input::get('descripcion'),
				'id' => Input::get('id')
			),
			array(
				'nombre' => 'required|max:100',
				'meta' => 'required|numeric',
				'finializa' => 'required',
				'descripcion' => 'required',
				'id' => 'required|exists:vaquita,id'
			)
		);

		if(!$validations->fails()){
			try{
				$vaca = Vaquita::find(Input::get('id'));
				$vaca->nombre = (Input::get('nombre') != "") ? Input::get('nombre') : $vaca->nombre ;
				$vaca->descripcion = (Input::get('descripcion') != "") ? Input::get('descripcion') : $vaca->descripcion ;
				$vaca->meta = (Input::get('meta') != "") ? Input::get('meta') : $vaca->meta ;
				$vaca->finish_at = (Input::get('finaliza') != "") ? Input::get('finaliza') : $vaca->finish_at ;
				$vaca->save();

				return array(
					'codigo' => 4210,
					'status' => true
				);
			}
			catch( QueryException $e){
				return array(
					'codigo' => 4211,
					'motivo' => 'Se genero un problema al tratar de actualizar la vaca, intenta más tarde',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 4211,
				'motivo' => 'La vaquita se encuentra con errores de validacion',
				'status' => false
			);
		}
	}

	public function addMeToVaquita($id){
		$yo = Usuario::where('username','=',Input::get('username'))->get();
		$validations = Validator::make(
			array(
				'id' => $id
			),
			array(
				'id' => 'required|exists:vaquita,id'
			)
		);

		if(!$validations->fails()){
			try{
				$colborador = new Integrante();
				$colborador->user_id = $yo[0]->id;
				$colborador->vaquita_id = $id;
				$colborador->save();

				return array(
					'codigo' => 4212,
					'status' => true
				);
			}
			catch( QueryException $e){
				return array(
					'codigo' => 4214,
					'motivo' => 'Se genero un problema al tratar suscribirse a la vaquita',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 4204,
				'motivo' => 'Vaquita solicitada no se encuentra en el sistema',
				'status' => false
			);
		}
	}

	public function deleteMeToVaquita($id){
		$yo = Usuario::where('username','=',Input::get('username'))->get();
		$validations = Validator::make(
			array(
				'id' => $id
			),
			array(
				'id' => 'required|exists:vaquita,id'
			)
		);

		if(!$validations->fails()){
			try{
				$colborador = Integrante::where('user_id','=',$yo[0]->id)
										->where('vaquita_id','=',$id)
										->delete();

				return array(
					'codigo' => 4213,
					'status' => true
				);
			}
			catch( QueryException $e){
				return array(
					'codigo' => 4215,
					'motivo' => 'Se genero un problema al tratar suscribirse a la vaquita',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 4204,
				'motivo' => 'Vaquita solicitada no se encuentra en el sistema',
				'status' => false
			);
		}
	}
	
}