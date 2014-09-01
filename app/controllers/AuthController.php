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
class AuthController extends BaseController {

    public function errorLogin(){
        $response = array(
            'mensaje' => 'La autenticacion en el sistema es obligatoria',
            'codigo'  => 203
        );
        return Response::json($response,403);
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
        if( Auth::attempt( $loginWithUser , Input::get('remember', 0)) || Auth::attempt( $loginWithEmail , Input::get('remember', 0)) ){
            $response = array(
                'mensaje' => 'Sesion Iniciada correctamente',
                'codigo'  => 200
            );
        }
        else{
            $response = array(
                'mensaje' => 'Sesion no Iniciada',
                'error' => 'Tus datos son incorrectos o estas deshabilitado',
                'codigo'  => 203
            );
        }
        return Response::json($response);
    }

    public function logOut(){
        Auth::logout();
        $response = array(
            'mensaje' => 'Tu sesión ha sido cerrada',
            'info' => 'Tu sesión ha sido cerrada',
            'codigo'  => 201
        );
        return Response::json($response);
    }
}
