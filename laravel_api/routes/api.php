<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->post('login', 'App\Http\Api\Auth\LoginController@login');
	$api->post('register', 'App\Http\Api\Auth\RegisterController@register');
	$api->group(['middleware'=>'api.auth'],function($api){
		$api->get('logout','App\Http\Api\Auth\LoginController@logout');
		$api->resource('user','App\Http\Api\UsersController');
	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
