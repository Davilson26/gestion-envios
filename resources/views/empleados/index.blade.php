@extends('adminlte::page')

@section('title', 'empleados')

@section('content_header')
    <h1>empleados</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h1 class="text-xl font-bold">Lista de Envios</h1>
            <div>
                <a href="{{ route('empleados.create') }}" class="btn btn-sm btn-outline-dark px-4 py-2 rounded ml-4">CREAR NUEVO CLIENTE</a>
            
            </div>
        </div>
        <div class="card-body">
            
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

              <table class="table  w-full responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Cedula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">cargo</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td class="text-center">{{ $empleado->id }}</td>
                            <td class="text-center">{{ $empleado->cedula }}</td>
                            <td class="text-center">{{ $empleado->nombres }}</td>
                            <td class="text-center">{{ $empleado->apellidos }}</td>
                            <td class="text-center">{{ $empleado->user->email ?? NULL}}</td>
                            <td class="text-center">{{ $empleado->cargo }}</td>
                            <td class="text-center">{{ $empleado->direccion }}</td>
                            <td class="text-center">
                                <a class="btn btn-outline-success btn-sm fas fa-edit" href="{{ route('empleados.edit', $empleado) }}"></a>
                                    
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" class="form-delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm fas fa-trash-alt"> </button>
                                </form>
                               

                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                                   
                     </form>
                </table>
                

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
