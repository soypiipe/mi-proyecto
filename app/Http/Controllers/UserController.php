<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UserController extends Controller
{
	
//Hace referencia a la pagina principal del modulo de usuarios
    public function index()
    {
    	// //Simulacion de BBDD usuarios para ejemplo
    	// if (request()->has('empty')) {
    	// 	//Si no se encuentra nada en BBDD
    	// 	$users = [];
    	// }else{

	    // 	$users = [
	    // 		'Diego',
	    // 		'Natalia',
	    // 		'Laura',
	    // 		'Sebastian',
	    // 		'Carlos',
	    // 		'Pedro'
	    // 	];	
    	// }

        $users = Users::all(); //Usando eloquen trae todos los usuarios

        $title = 'Listado de usuarios';
    	
    	return view('users.index', compact('title', 'users'));
    	//->with('users',$users)
    	//->with('title', 'Listado de usuarios'); #pasado parametros a la vista con un solo with y array asociativo o un with por cada parametros
    }

    //Muestra detalle del usuario. Viene de la ruta que solicita el id
    public function show($id)
    {
        $user = Users::find($id);
    	return view('users.show', compact('user'));
    }

    public function create()
    {
    	return view('users.created')
    	-> with('title', 'Crear usuario');
    }
}
