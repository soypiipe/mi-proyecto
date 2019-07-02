@extends('layout')

@section('title',"Usuario {$user->id}")

@section('content')

<div class="card">
    <div class="card-header">
        <h1> Usuario #{{ $user->id }}</h1>
    </div>
    <div class="card-body">
        <p> <strong> Nombre del usuario: </strong> {{ $user->name }}</p>
        <p> <strong> Email del usuario: </strong> {{ $user->email }}</p>

        <p> <a href="{{ route('users') }}">Regresar al listado de usuarios</a></p>
    </div>
    
</div>
	
@endsection

