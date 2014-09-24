<?php
header('Access-Control-Allow-Origin: http://mydrawings.herokuapp.com');
header('Access-Control-Allow-Credentials: true');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::when('*', 'csrf', array('post'));

Route::get('/', function() {
	return View::make('index');
});

Route::controller('drawings','DrawingController');
Route::controller('user','UserController');

Route::get('auth/csrf_token', function(){
  return Response::json(array('csrf_token' => csrf_token()));
});
Route::post('/auth/login', array('uses' => 'AuthController@login'));
Route::post('/auth/register', array('uses' => 'AuthController@register'));
Route::get('/auth/logout', 'AuthController@logout');