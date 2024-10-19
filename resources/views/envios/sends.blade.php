@extends('adminlte::page')

@section('title', 'Envios')

@section('content_header')
<h1>Envíos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header flex justify-between items-center">
        <h1 class="text-xl font-bold">Mis Envíos</h1>
    </div>
    <div class="card-body">

        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <table id="myTable" class="table w-full responsive">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Origen</th>
                    <th class="text-center">Destino</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Código de Envío</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Detalles del Envío</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($envios as $envio)
                    <tr>
                        <td class="text-center">{{ $envio->id }}</td>
                        <td class="text-center">{{ $envio->origen }}</td>
                        <td class="text-center">{{ $envio->destino }}</td>
                        <td class="text-center">{{ $envio->descripcion }}</td>
                        <td class="text-center">{{ $envio->codigo_envio }}</td>
                        <td class="text-center">
                            @if($envio->estado == 1)
                                En Proceso
                            @elseif($envio->estado == 2)
                                Enviado
                            @else
                                Entregado
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach ($envio->enviosDetalles as $detalle)
                                    <li>
                                        Peso: {{ $detalle->peso }} {{ $detalle->unidad_peso }},
                                        Alto: {{ $detalle->alto }} {{ $detalle->unidad_medidas }},
                                        Ancho: {{ $detalle->ancho }} {{ $detalle->unidad_medidas }},
                                        Cantidad: {{ $detalle->cantidad }} {{ $detalle->unidad_cantidades }},
                                        Valor Total: {{ $detalle->valor_total }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-outline-success btn-sm fas fa-edit"
                                href="{{ route('envios.edit', $envio->id) }}"></a>
                            <!--  <form action="{{ route('envios.destroy', $envio->id) }}" class="form-delete" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm fas fa-trash-alt"> </button>
                    </form> -->
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
