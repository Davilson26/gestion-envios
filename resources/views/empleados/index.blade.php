@extends('adminlte::page')

@section('title', 'empleados')

@section('content_header')
    <h1 class="text-xl font-bold">Lista de empleados</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <div>
                <a href="{{ route('empleados.create') }}" class="btn btn-sm btn-outline-dark px-4 py-2 rounded ml-4">CREAR NUEVO EMPLEADO</a>

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
                                <div class="d-inline-flex align-items-center gap-3">
                                    <a class="btn btn-outline-success btn-sm fas fa-edit mr-2" href="{{ route('empleados.edit', $empleado) }}"></a>

                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" class="form-delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm fas fa-trash-alt"> </button>
                                    </form>
                                </div>
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

        $('.form-delete').on('submit', function(e){
            e.preventDefault();
            swal.fire({
                title: '¿Estás seguro?',
                text: "Este registro se eliminará!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@stop
