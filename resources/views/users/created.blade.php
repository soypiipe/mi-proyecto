@extends('layout')

@section('title',"Crear usuario")


@section('content')

<div class="card">
    <div class="card-header">
        <h1>Crear nuevo usuario</h1>
    </div>
    <div class="card-body">
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
            <button class="btn btn-primary" type="submit"> Crear Usuario</button>
            <a href="{{ route('users') }}" class="btn btn-link">Regresar al listado de usuarios</a>
        </form>

        <p class="mt-5 mb-3 text-muted text-center"> 

        </p>
    </div>
</div>



@endsection