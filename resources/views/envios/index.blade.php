@extends('adminlte::page')

@section('title', 'Envios')

@section('content_header')
    <h1>Sends</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            Lista de Envios
            <div class="mb-4">
                <a href="{{ route('clientes.create') }}" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">CREAR NUEVO CLIENTE</a>
            </div>

        </div>
        <div class="card-body">

            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

              <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">NOMBRE</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">APELLIDO</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">CORREO</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">TELEFONO</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">DIRECCIÓN</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $client)
                        <tr>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->id }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->nombre }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->apellido }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->correo }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->telefono }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $client->direccion }}</td>
                            
                            <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                <a href="{{ route('clientes.edit', $client) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                <form action="{{ route('clientes.destroy', $client->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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
