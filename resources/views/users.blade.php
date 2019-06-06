@extends('layout')

@section('content')
	<br>
	<br>
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

@section('sidebar')
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