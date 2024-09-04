@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>actualizar Cliente</h1>
@stop

@section('content')

<div class="row d-flex justify-content-center text-center" style="max-width: 500px; margin: 0 auto;">
    <div class="card border border-dark rounded-3" style="width: 100%; border-radius: 20px;">
        <div class="card-header">
            <h1>actualizar cliente</h1>
        </div>
        <div class="card-body">
            <!-- Actualiza el formulario para que utilice el método PUT y apunte a la ruta update -->
<form action="{{ route('clientes.index', $cliente->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nombres">Nombre</label>
        <input type="text" class="form-control text-center" id="nombres" name="nombres" value="{{ $cliente->nombres }}" required>
    </div>

    <div class="form-group">
        <label for="apellidos">Apellido</label>
        <input type="text" class="form-control text-center" id="apellidos" name="apellidos" value="{{ $cliente->apellidos }}" required>
    </div>

    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control text-center" id="correo" name="correo" value="{{ $user->email }}" required>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control text-center" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
    </div>

    <div class="form-group">
        <label for="direccion">Dirección</label>
        <textarea class="form-control" id="direccion" name="direccion" rows="3" required>{{ $cliente->direccion }}</textarea>
    </div>
    
    <div class="form-group">
        <label for="password">Nueva Contraseña</label>
        <input type="password" class="form-control text-center" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" class="form-control text-center" id="password_confirmation" name="password_confirmation">
    </div>

    <!-- Botón para actualizar -->
    <button type="submit" class="btn btn-success btn-block">
        Actualizar Cliente
    </button>
</form>