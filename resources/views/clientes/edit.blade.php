@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Client</h1>
@stop

@section('content')

<div class="row d-flex justify-content-center text-center" style="max-width: 500px; margin: 0 auto;">
    <div class="card border border-dark rounded-3" style="width: 100%; border-radius: 20px;">
        <div class="card-header">
            <h1>Crear cliente</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cedula">Id</label>
                    <input type="number" class="form-control text-center" id="cedula" name="cedula" value="{{ $cliente->id ?? '' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $cliente->apellido ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->correo ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <textarea class="form-control" id="direccion" name="direccion" rows="3" required>{{ $cliente->direccion ?? '' }}</textarea>
                </div>

                <!-- Campo oculto para rol_id -->
                <input type="hidden" name="rol_id" value="4">

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

        </div>
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
