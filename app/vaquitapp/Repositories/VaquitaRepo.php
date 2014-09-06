<?php namespace vaquitapp\Repositories;

use vaquitapp\Entities\Vaquita;
use vaquitapp\Entities\Usuario;

use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;

class VaquitaRepo extends BaseRepo{

	public function vaquitas(){
		$user = Usuario::where('username','=',Input::get('username'))->get();
		try{
			return Vaquita::where('admin','=',$user[0]->id)
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function suscrito(){
		try{
			$user = Usuario::where('username','=',Input::get('username'))->get();
			return Usuario::join('usuarios_vaquita','user_id','=','usuarios.id')
					->join('vaquita','vaquita_id','=','vaquita.id')
					->where('user_id','=',$user[0]->id)
					->select('vaquita.*')
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function show($id){
		try{
			return Vaquita::where('id','=',$id)
					->where('estado','=','1')
					->get()
					->toArray();
		}
		catch( QueryException $e){
			return false;
		}
	}

	public function getModel(){
		return new Vaquita;
	}

}
