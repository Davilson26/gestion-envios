<!-- resources/views/envios/mis-envios.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Mis Envíos</h1>

    @if($envios->isEmpty())
        <p>No tienes envíos registrados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Código de Envío</th>
                    <th>Destino</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($envios as $envio)
                    <tr>
                        <td>{{ $envio->codigo_envio }}</td>
                        <td>{{ $envio->destino }}</td>
                        <td>{{ $envio->descripcion }}</td>
                        <td>{{ $envio->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
