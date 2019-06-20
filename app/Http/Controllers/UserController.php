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

        //$users = Users::all(); //Usando eloquen trae todos los usuarios
        $users = Users::orderBy('id','ASC')->paginate(5);
        $title = 'Listado de usuarios';
    	
    	return view('users.index', compact('title', 'users'));
    	//->with('users',$users)
    	//->with('title', 'Listado de usuarios'); #pasado parametros a la vista con un solo with y array asociativo o un with por cada parametros
    }

    //Muestra detalle del usuario. Viene de la ruta que solicita el id
    public function show(Users $user)
    {
        return view('users.show', compact('user'));
        
    }
    
    public function store(){
        
        //Recibe los datos del formulario y valida que el nombre es obligatorio
        $data = request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required','email', 'unique:users,email'],//Validad s es unico: hay que psar el nombre de la tabla y campo a validar
            'password' => ['required','Min:6'],
            'document' => ['required', 'unique:users,document'],
            'username' => ['required', 'unique:users,username'],
            'birth_date' => '',
            'cel' => '',
            'address' => ''
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'Email invalido',
            'email.unique' => 'Email duplicado',
            'password.min' => 'Minimo 6 caracteres'
        ]);
        
//        if (empty($data['name'])){
//            return redirect('usuarios/nuevo')->withErrors([
//                'name' => 'El campo nombre es obligatorio'
//            ]);
//        }
        
        Users::create([
           'name' => $data['name'],
           'lastname' => $data['lastname'],
           'email' => $data['email'],
           'password' => bcrypt($data['password']),
            'document' => $data['document'],
            'username' => $data['username'],
            'birth_date' => $data['birth_date'],
            'cel' => $data['cel'],
            'address' => $data['address']
        ]);
        
        return redirect()->route('users');
    }

    public function create()
    {
    	return view('users.created')
    	-> with('title', 'Crear usuario');
    }
    
    public function edit(Users $user){
        return view('users.edit', compact('user'));
    }
    
    public function update(Users $user){
        $data = request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required','email', 'unique:users,email,'.$user->id],//Validad s es unico: hay que psar el nombre de la tabla y campo a validar y enviando el id, descarta el email del usuario en cuestion  
            'password' => '',
            'document' => ['required', 'unique:users,document,'.$user->id],
            'username' => ['required', 'unique:users,username,'.$user->id],
            'birth_date' => '',
            'cel' => '',
            'address' => ''
        ],
        [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'Email invalido',
            //'email.unique' => 'Email duplicado',
            //'password.required' => 'Password requerido'
        ]);
        
        if($data['password'] != null){
            $data['password'] = bcrypt($data['password']); 
        }else{
            unset($data['password']); // Si viene vacio quita la variable del array asociativo
        }
        
        
        
        $user->update($data);
        
        return redirect()->route('users.show', ['user' => $user]);
    }
}
