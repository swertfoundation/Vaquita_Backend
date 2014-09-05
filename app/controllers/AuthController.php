<?php
/*
|--------------------------------------------------------------------------
| AuthController
|--------------------------------------------------------------------------
|
| Controlador encargado de gestionar todas las peticiones relacionadas con
| el login o las sesiones de los usuarios generados en el sistema
|
*/
use vaquitapp\Entities\Usuario;

class AuthController extends BaseController {

    public function errorLogin(){
        $response = array(
            'mensaje' => 'La autenticacion en el sistema es obligatoria',
            'codigo'  => 2103
        );
        return Response::json($response);
    }

    public function doLogin(){
        $loginWithUser = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'estado'   => '1'
        );
        $loginWithEmail = array(
            'email' => Input::get('username'),
            'password' => Input::get('password'),
            'estado'   => '1'
        );
        if( Auth::attempt($loginWithUser) || Auth::attempt($loginWithEmail) ){

            $userlogin = Usuario::find(Auth::user()->id);
            $userlogin->firefoxos_token =Auth::user()->username."&".Auth::user()->id;
            $userlogin->save();

            $response = array(
                'mensaje' => 'Sesion Iniciada correctamente',
                'token' => Crypt::encrypt(Auth::user()->username."&".Auth::user()->id),
                'codigo'  => 2101
            );
        }
        else{
            $response = array(
                'mensaje' => 'Sesion no Iniciada',
                'error' => 'Tus datos son incorrectos o estas deshabilitado',
                'codigo'  => 2103
            );
        }
        return Response::json($response);
    }

    public function logOut(){
        Auth::logout();
        $response = array(
            'mensaje' => 'Tu sesión ha sido cerrada',
            'info' => 'Tu sesión ha sido cerrada',
            'codigo'  => 2102
        );
        return Response::json($response);
    }
}
