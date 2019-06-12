@extends('layout')

@section('title',"Usuario {$id}")

@section('content')

	<h1> Usuario #{{ $user->id }}</h1>
	
	<p>Nombre del usuario: {{ $user->name }}</p>
    <p>Email del usuario: {{ $user->email }}</p>

    <p> <a href="{{ url('/usuarios') }}">Regresar</a></p>
	
@endsection


