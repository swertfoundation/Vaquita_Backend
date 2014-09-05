<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/
use vaquitapp\Entities\Usuario;

App::before(function($request)
{
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('auth.firefoxos', function(){
	$data = array(
		'username' => Input::get('username'),
		'firefoxos' => Input::get('token')
	);
	$rules = array(
		'username' => 'required|exists:usuarios,username',
		'firefoxos' => 'required'
	);
	$validators = Validator::make($data, $rules);
	if(!$validators->fails()){
		$infoData = explode("&", Crypt::decrypt(Input::get('token')));
		$tempLogin = Usuario::where('username','=',$infoData[0])
							->where('id','=',$infoData[1])
							->get();
		if(isset($tempLogin[0]->estado) && $tempLogin[0]->estado != 1){
			$response = array(
				'mensaje' => 'Credenciales no validas',
				'codigo'  => '2103'
			);
			return Response::json($response);
		}
	}
	else{
		$response = array(
			'mensaje' => 'Credenciales no validas',
			'codigo'  => '2103'
		);
		return Response::json($response);
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
