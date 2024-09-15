@extends('adminlte::page')

@section('title', 'empleados')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
<div class="row d-flex justify-content-center text-center" style="max-width: 500px; margin: 0 auto;">
    <div class="card border border-dark rounded-3" style="width: 100%; border-radius: 20px;">
        <div class="card-header">
            <h1>Crear Empleados</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="number" class="form-control text-center" id="cedula" name="cedula">
                </div>

                <div class="form-group">
                    <label for="nombres">Nombre</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellido</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                </div>
                <div class="form-group">
                    <label for="direccion">direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>


                <div class="form-group">
                    <label for="correo">cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" required>
                </div>
                 <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>

                <div class="form-group">
                    <label for="correo">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

            

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
