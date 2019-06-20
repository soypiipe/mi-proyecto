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
        
        <div class="form-label-group">
            <input class="form-control" type="text" name='name' id="name" placeholder="Nombre" value="{{ old('name') }}">
            <input class="form-control" type="text" name='lastname' id="lastname" placeholder="Apellido" value="{{ old('lastname') }}">
            <!-- <label for="name">Nombre: </label> -->
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name="document" id="document" placeholder="Documento" value="{{ old('document') }}">
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name="username" id="username" placeholder="Usuario" value="{{ old('username') }}">
        </div>
        <br>
        <div class="form-label-group">
            <label for="name">Fecha de nacimiento: </label>
            <input class="form-control" type="date" name="birth_date" id="birth_date" placeholder="Fecha de nacimiento" value="{{ old('birth_date') }}">
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name="cel" id="cel" placeholder="Celular" value="{{ old('cel') }}">
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name="address" id="address" placeholder="Direccion" value="{{ old('address') }}">
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="text" name='email' id="email" placeholder="Correo electronico" value="{{ old('email') }}">
            <!-- 
            @if($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                   
                    <p> {{ $errors->first('email') }} </p>
                   
                </div>
            @endif -->
        </div>
        <br>
        <div class="form-label-group">
            <input class="form-control" type="password" name='password' id="password" placeholder="Password">
            <!-- 
            @if($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                   
                    <p> {{ $errors->first('password') }} </p>
                   
                </div>
            @endif -->
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit"> Crear Usuario</button>
    </form>

    <p class="mt-5 mb-3 text-muted text-center"> 
        <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
    </p>
	
@endsection