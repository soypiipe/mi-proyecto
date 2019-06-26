@extends('layout')
 
@section('content')
        
        <div class="d-flex justify-content-between align-items-end mb-2">
            <h1 class="pb-1">{{ $title }}</h1>
            <p>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
            </p>
        </div>
	
        @if($users->isNotEmpty())
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id}}</th>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                            <form action="{{route('users.destroy', $user)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('users.show',$user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                                <a href="{{ route('users.edit',$user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                                <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                
                @endforeach
                
            </tbody>
        </table>
        
        {!! $users->render() !!}
        @else
            <p class="alert alert-warning" role="alert">No hay usuarios registrados</p>
        @endif
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
