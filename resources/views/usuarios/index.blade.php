@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>Listado de Usuarios</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success" id="alert">
    <strong>{{session('info')}}</strong>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table id="usuarios" class="table table-striped" >
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td width="10px"><a class="btn btn-success btn-sm" href="{{route('usuarios.edit', $user)}}"><i class="fas fa-user-tag"></i></a></td>
                    <td width="10px">
                        <form action="{{route('usuarios.destroy',$user)}}" class="form-delete" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt"> </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')

<script>
    $(document).ready(function() {
        $('#alert').fadeIn();
        setTimeout(function() {
            $("#alert").fadeOut();
        },2000);
        $('#usuarios').DataTable({
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
    } );
</script>
@stop
