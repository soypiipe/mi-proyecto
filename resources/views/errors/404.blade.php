@extends('layout')

@section('title',"Pagina no encontrada")


<style>
    body {
        background: #dedede;
    }
    .page-wrap {
        min-height: 100vh;
    }
</style>
@section('error')
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">Pagina no encontrada</div>
                <a href="{{route('users')}}" class="btn btn-link">Usuarios</a>
            </div>
        </div>
    </div>
</div>

@endsection