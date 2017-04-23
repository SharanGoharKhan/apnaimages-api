<?php
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//develop branch 
Route::get('/', function () {
    return "Api is running";
});
//Route::post('auth/register','Auth\RegisterController@register');
Route::group(['prefix'=>'auth'],function()
{
	Route::resource('register','Auth\AuthenticateController', ['only' => ['index']]);
	Route::post('register', 'Auth\AuthenticateController@authenticate');
});

