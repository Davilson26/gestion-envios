@extends('adminlte::page')

@section('title', 'Editar empleado')

@section('content_header')
    <h1>Editar empleados</h1>
@stop

@section('content')

<div class="row d-flex justify-content-center text-center" style="max-width: 500px; margin: 0 auto;">
    <div class="card border border-dark rounded-3" style="width: 100%; border-radius: 20px;">
        <div class="card-header">
            <h1>Editar empleados</h1>
        </div>
        <div class="card-body">
            <!-- Actualiza el formulario para que utilice el método PUT y apunte a la ruta update -->
            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="cedula">Id</label>
                    <input type="number" class="form-control text-center" id="cedula" name="cedula" value="{{ $empleado->id }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nombres">Nombre</label>
                    <input type="text" class="form-control text-center" id="nombres" name="nombres" value="{{ $empleado->nombres }}" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellido</label>
                    <input type="text" class="form-control text-center" id="apellidos" name="apellidos" value="{{ $empleado->apellidos }}" required>
                </div>
                   <div class="form-group">
                    <label for="cargo">cargo</label>
                    <input type="text" class="form-control text-center" id="cargo" name="cargo" value="{{ $empleado->cargo}}" required>
                </div>


                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control text-center" id="correo" name="correo" value="{{ $user->email }}" required>
                </div>

                
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" class="form-control text-center" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" class="form-control text-center" id="password_confirmation" name="password_confirmation">
                </div>

                <!-- Campo oculto para rol_id -->
                <input type="hidden" name="rol_id" value="4">

                <button type="submit" class="btn btn-primary">Actualizar</button>
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
