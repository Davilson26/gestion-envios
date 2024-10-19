@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de clientes</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <div>
                <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-outline-dark px-4 py-2 rounded ml-4">CREAR NUEVO CLIENTE</a>

            </div>
        </div>
        <div class="card-body">

            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

              <table  id="myTable" class="table  w-full responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Cedula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td class="text-center">{{ $cliente->id }}</td>
                            <td class="text-center">{{ $cliente->cedula }}</td>
                            <td class="text-center">{{ $cliente->nombres }}</td>
                            <td class="text-center">{{ $cliente->apellidos }}</td>
                            <td class="text-center">{{ $cliente->user->email ?? NULL}}</td>
                            <td class="text-center">{{ $cliente->telefono }}</td>
                            <td class="text-center">{{ $cliente->direccion }}</td>
                            <td class="text-center">
                                <a class="btn btn-outline-success btn-sm fas fa-edit" href="{{ route('clientes.edit', $cliente) }}"></a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}" class="form-delete" method="POST">
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
$(document).ready(function() {
        $('#myTable').DataTable({
            responsive:true,
            autoWidth:false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search": "Buscar",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    } );
    </script>
@stop
