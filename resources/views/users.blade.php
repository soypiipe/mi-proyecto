<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de usuarios - Styde.net</title>
</head>
<body>
	<h1>{{ $title }}</h1>
	<hr>
	@if(! empty($users))
		<ul>
			
			@foreach ($users as $user)
				<li>{{ $user }}</li>	
			@endforeach
		</ul>
	@else
		<p>No hay usuarios registrados</p>
	@endif

</body>
</html>