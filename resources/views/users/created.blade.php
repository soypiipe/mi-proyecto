@extends('layout')

@section('title',"Crear usuario")


@section('content')

    <h1> Crear neuvo usuario </h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por favor corrige los errores de abajo:</h6>
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif  
	
    <form class="form-signin" method="POST" action="{{ url('usuarios') }}">
        {{ csrf_field() }}
        
        <div class="form-group">            
            <label for="name">Nombre: </label> 
            <input class="form-control" type="text" name='name' id="name" placeholder="Nombre" value="{{ old('name') }}">
        </div>
        
        <div class="form-group">
            <label for="email">Correo electronico: </label>
            <input class="form-control" type="text" name='email' id="email" placeholder="Correo electronico" value="{{ old('email') }}">
        </div>
        
        <div class="form-group"> 
            <label for="password">Password: </label>
            <input class="form-control" type="password" name='password' id="password" placeholder="Password">
        </div>
        
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit"> Crear Usuario</button>
    </form>

    <p class="mt-5 mb-3 text-muted text-center"> 
        <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
    </p>
	
@endsection