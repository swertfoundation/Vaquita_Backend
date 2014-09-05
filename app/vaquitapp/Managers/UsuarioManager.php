<?php namespace vaquitapp\Managers;

use vaquitapp\Entities\Usuario;
use vaquitapp\Entities\Amigo;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class UsuarioManager{
	
	protected $user;
	protected $amistad;

	function __construct(Usuario $user,Amigo $amigo){
		$this->user = $user;
		$this->amistad = $amigo;
	}

	public function addFriend($id){
		$validations = Validator::make(
			array(
				'id' => $id
			),
			array(
				'id' => 'required|exists:usuarios,id'
			)
		);

		if(!$validations->fails()){
			try{
				$verifyData = Usuario::whereIn('usuarios.id',
						array_merge(
							Usuario::join('amigos','user_id','=','usuarios.id')
									->select('amigo_id')
									->where('usuarios.id','=',$id)
									->get()->toArray(),
							Usuario::join('amigos','amigo_id','=','usuarios.id')
									->select('user_id')
									->where('usuarios.id','=',$id)
									->get()->toArray()
						)
					)
					->get()
					->toArray();
			}
			catch( QueryException $e){
				$verifyData = array();
			}
			if(count($verifyData) == 0){
				$yo = Usuario::where('username','=',Input::get('username'))->get();
				$amigo = new Amigo();
				$amigo->user_id = $yo[0]->id;
				$amigo->amigo_id = $id;
				$amigo->estado = 0;
				$amigo->save();
				return array(
					'codigo' => 3406,
					'status' => true
				);
			}
			else{
				return array(
					'codigo' => 3411,
					'motivo' => 'Los usuarios ya son amigos en el sistema o la solicitud de amistad ya fue enviada',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 3404,
				'motivo' => 'Usuario solicitado no se encuentra en el sistema',
				'status' => false
			);
		}
	}

	public function deleteFriend($id){
		$validations = Validator::make(
			array(
				'id' => $id
			),
			array(
				'id' => 'required|exists:usuarios,id'
			)
		);

		if(!$validations->fails()){
			try{
				$verifyData = Usuario::whereIn('usuarios.id',
						array_merge(
							Usuario::join('amigos','user_id','=','usuarios.id')
									->select('amigo_id')
									->where('usuarios.id','=',$id)
									->get()->toArray(),
							Usuario::join('amigos','amigo_id','=','usuarios.id')
									->select('user_id')
									->where('usuarios.id','=',$id)
									->get()->toArray()
						)
					)
					->get()
					->toArray();
			}
			catch( QueryException $e){
				$verifyData = array();
			}
			if(count($verifyData) > 0){
				$yo = Usuario::where('username','=',Input::get('username'))->get();
				try{
					$amigo = Amigo::where('user_id','=',$yo[0]->id)
							->where('amigo_id','=',$id)
							->delete();
				}
				catch(QueryException $e){
					try{
						$amigo = Amigo::where('amigo_id','=',$yo[0]->id)
							->where('user_id','=',$id)
							->delete();
					}
					catch(QueryException $e){
						return array(
							'codigo' => 3409,
							'motivo' => 'Existe mas de una coincidencia del usuario',
							'status' => false
						);
					}
				}

				return array(
					'codigo' => 3408,
					'status' => true
				);
			}
			else{
				return array(
					'codigo' => 3412,
					'motivo' => 'Los usuarios no son amigos en el sistema',
					'status' => false
				);
			}
		}
		else{
			return array(
				'codigo' => 3404,
				'motivo' => 'Usuario solicitado no se encuentra en el sistema',
				'status' => false
			);
		}
	}

}