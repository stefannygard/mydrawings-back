<?php
header('Access-Control-Allow-Origin: *');

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

Route::get('/', function() {
	return View::make('index');
});

Route::controller('drawings','DrawingController');
Route::controller('user','UserController');

Route::get('auth/csrf_token', function(){
  return Response::json(array('csrf_token' => csrf_token()));
});
Route::post('/auth/login', array('before' => 'csrf_json', 'uses' => 'AuthController@login'));
Route::post('/auth/register', array('before' => 'csrf_json', 'uses' => 'AuthController@register'));
Route::get('/auth/logout', 'AuthController@logout');