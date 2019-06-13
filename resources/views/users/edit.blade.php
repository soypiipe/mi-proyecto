@extends('layout')

@section('title',"Editar usuario")

@section('content')

    <h1>Editar usuario</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por fvor corrige los errores de abajo:</h6>
         <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif  
    
    <form class="form-signin" method="POST" action='{{ url("usuarios/{$user->id}") }}'>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        
        <div class="form-label-group">
            <input class="form-control" type="text" name='name' id="name" placeholder="Nombre" value="{{ old('name', $user->name)  }}">
            <!-- <label for="name">Nombre: </label> -->
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name='email' id="email" placeholder="Correo electronico" value="{{ old('email', $user->email) }}">
            <!-- <label for="email">Correo electronico: </label> -->

        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="password" name='password' id="password" placeholder="Password">
            <!-- <label for="password">Password: </label> -->
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit"> Actualizar Usuario</button>
    </form>

    <p class="mt-5 mb-3 text-muted text-center"> 
        <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
    </p>
	
@endsection