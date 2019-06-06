<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	//Hace referencia a la pagina principal del modulo de usuarios
    public function index()
    {
    	//Simulacion de BBDD usuarios para ejemplo
    	if (request()->has('empty')) {
    		//Si no se encuentra nada en BBDD
    		$users = [];
    	}else{

	    	$users = [
	    		'Diego',
	    		'Natalia',
	    		'Laura',
	    		'Sebastian',
	    		'Carlos',
	    		'Pedro'
	    	];	
    	}
    	

    	return view('users')
    	->with('users',$users)
    	->with('title', 'Listado de usuarios'); #pasado parametros a la vista con un solo with y array asociativo o un with por cada parametros
    }

    //Muestra detalle del usuario. Viene de la ruta que solicita el id
    public function show($id)
    {
    	return view('users_detail', compact('id'));
    }

    public function create()
    {
    	return view('users_created')
    	-> with('title', 'Crear usuario');
    }
}