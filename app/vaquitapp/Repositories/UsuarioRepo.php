<?php namespace vaquitapp\Repositories;

use vaquitapp\Entities\Usuario;

use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;

class UsuarioRepo extends BaseRepo{

	public function friends(){
		try{
			return Usuario::whereIn('usuarios.id',
						array_merge(
							Usuario::join('amigos','user_id','=','usuarios.id')
									->select('amigo_id')
									->where('username','=',Input::get('username'))
									->where('amigos.estado','=','1')
									->get()->toArray(),
							Usuario::join('amigos','amigo_id','=','usuarios.id')
									->select('user_id')
									->where('username','=',Input::get('username'))
									->where('amigos.estado','=','1')
									->get()->toArray()
						)
					)
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function waiting(){
		try{
			return Usuario::whereIn('usuarios.id',
						Usuario::join('amigos','user_id','=','usuarios.id')
								->select('amigo_id')
								->where('username','=',Input::get('username'))
								->where('amigos.estado','=','0')
								->get()->toArray()
					)
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function confirm(){
		try{
			return Usuario::whereIn('usuarios.id',
						Usuario::join('amigos','amigo_id','=','usuarios.id')
								->select('user_id')
								->where('username','=',Input::get('username'))
								->where('amigos.estado','=','0')
								->get()->toArray()
					)
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function externalFriends($id){
		try{
			return Usuario::whereIn('usuarios.id',
						array_merge(
							Usuario::join('amigos','user_id','=','usuarios.id')
									->select('amigo_id')
									->where('usuarios.id','=',$id)
									->where('amigos.estado','=','1')
									->get()->toArray(),
							Usuario::join('amigos','amigo_id','=','usuarios.id')
									->select('user_id')
									->where('usuarios.id','=',$id)
									->where('amigos.estado','=','1')
									->get()->toArray()
						)
					)
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function friend($id){
		try{
			return Usuario::where('id','=',$id)
					->where('estado','=','1')
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function getModel(){
		return new Usuario;
	}

}
