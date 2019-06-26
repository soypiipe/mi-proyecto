@extends('layout')
 
@section('content')

	<h1>{{ $title }}</h1>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
        
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id}}</th>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                            <a href="{{ route('users.show',['id' => $user->id]) }}">Ver detalles</a>
                            <a href="{{ route('users.edit',['id' => $user->id]) }}">Editar</a>
                        </td>
                    </tr>
                @empty
                    <p>No hay usuarios registrados</p>
                @endforelse
                
            </tbody>
        </table>
@endsection


@section('sidebar') @php // Se pueden sobreescribir seeciones. Esta seccion ya esta definida en layout @endphp

@php //Si no se quiere reescribir sino, solo modificar tanto arriba como abajo de la seccion se usa @parent @endphp
	@parent

@endsection




<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de usuarios - Styde.net</title>
</head>
<body>
	<h1>{{ $title }}</h1>
	<hr>
	
	<ul>
		@forelse ($users as $user) //Funciona como un foreach pero con condicional
			<li>{{ $user->name }}</li>	
		@empty
			<<li>No hay usuarios registrados </li>
		@endforelse
	</ul>	

</body>
</html>-->
