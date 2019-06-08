@extends('layout')
 
@section('content')

	<h1>{{ $title }}</h1>
	@if(! empty($users))
		<ul>
			@foreach ($users as $user)
				<li>{{ $user }}</li>	
			@endforeach
		</ul>
	@else
		<p>No hay usuarios registrados</p>
	@endif

	{{ date('Y-m-d',time()) }}
@endsection


@section('sidebar') @php // Se pueden sobreescribir seeciones. Esta seccion ya esta definida en layout @endphp

@php //Si no se quiere reescribir sino, solo modificar tanto arriba como abajo de la seccion se usa @parent @endphp
	@parent
	<h2>Barra lateral personalizada</h2>

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
			<li>{{ $user }}</li>	
		@empty
			<<li>No hay usuarios registrados </li>
		@endforelse
	</ul>	

</body>
</html>-->