<?php

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

Route::get('/', function ()
{
	return 'Home';
});

//Ruta que define la entrada al modulo usuarios, pasndo por el controlador y el metodo index. 'UserController@index Controlador@metodo
Route::get('/usuarios', 'UserController@index')->name('users');

Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');

Route::post("/usuarios", "UserController@store");

Route::get('/usuarios/{user}', 'UserController@show')->where('user', '[0-9]+')->name('users.show');

//Paso de mas de un parametro y nickname opcional usando ?
Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController'); #No es necesario pasarle el nombre del metodo ya que el controlador solo tiene un metodo y se llama __invoke



