@extends('adminlte::page')

@section('title', '403')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>403 No tienes permisos para acceder aquí</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">403</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="error-page">
    <h2 class="headline text-warning"> 403</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! No tienes permisos para acceder aquí.</h3>
        <p>
            Consulta con tu administrador si debes tener acceso a este apartado.

            De momento, tu puedes <a href="/home">regresar al dashboard.</a>
        </p>
    </div>

</div>
@stop

@section('js')

@stop
