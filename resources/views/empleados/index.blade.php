@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Client</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            Lista de Empleados
        </div>
        <div class="card-body">


        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
