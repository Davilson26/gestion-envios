@extends('adminlte::page')

@section('title', 'Editar Envío')

@section('content_header')
    <h1>Editar Envío</h1>
@stop

@section('content')
<div class="row d-flex justify-content-center">
    <!-- Primera tarjeta: Editar Envíos -->
    <div class="col-md-6">
        <div class="card adorable-card">
            <div class="card-header adorable-card-header">
                <h1>Editar Envío</h1>
            </div>
            <div class="card-body adorable-card-body">
                <form action="{{ route('envios.update', $envio->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="idremitente">Cédula Remitente</label>
                                <input type="number" name="idremitente" id="idremitente" class="form-control adorable-input" value="{{ old('idremitente', $envio->idremitente) }}" step="0.01" required>
                            </div>
                        </div> 

                        <div class="col-6">
                            <div class="form-group">
                                <label for="iddestinatario">Cédula Destinatario</label>
                                <input type="number" name="iddestinatario" id="iddestinatario" class="form-control adorable-input" value="{{ old('iddestinatario', $envio->iddestinatario) }}" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="origen">Origen</label>
                        <input type="text" name="origen" id="origen" class="form-control adorable-input" value="{{ old('origen', $envio->origen) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="destino">Destino</label>
                        <input type="text" name="destino" id="destino" class="form-control adorable-input" value="{{ old('destino', $envio->destino) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control adorable-input" rows="2" required>{{ old('descripcion', $envio->descripcion) }}</textarea>
                    </div>
            </div>
        </div>
    </div>

    <!-- Segunda tarjeta: Detalles del Envío -->
    <div class="col-md-6">
        <div class="card adorable-card">
            <div class="card-header adorable-card-header">
                <h2>Detalles del Envío</h2>
            </div>
            <div class="card-body adorable-card-body">
                <div id="detalles-envio-container">
                    <div class="detalle-envio">
                        <div class="row mb-2">
                            <div class="col-3">
                                <label for="peso">Peso</label>
                                <input type="number" name="detalles[0][peso]" id="peso" class="form-control adorable-input" value="{{ old('detalles[0][peso]', $envio->detalles[0]['peso']) }}" step="0.01">
                            </div>
                            <div class="col-3">
                                <label for="ancho">Ancho</label>
                                <input type="number" name="detalles[0][ancho]" id="ancho" class="form-control adorable-input" value="{{ old('detalles[0][ancho]', $envio->detalles[0]['ancho']) }}" step="0.01"> 
                            </div>

                            <div class="col-3">
                                <label for="profundidad">Profundidad</label>
                                <input type="number" name="detalles[0][profundidad]" id="profundidad" class="form-control adorable-input" value="{{ old('detalles[0][profundidad]', $envio->detalles[0]['profundidad']) }}" step="0.01">
                            </div>

                            <div class="col-3">
                                <label for="alto">Alto</label>
                                <input type="number" name="detalles[0][alto]" id="alto" class="form-control adorable-input" value="{{ old('detalles[0][alto]', $envio->detalles[0]['alto']) }}" step="0.01">
                            </div>                           
                        </div>

                        <div class="form-group mt-3">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="detalles[0][cantidad]" id="cantidad" class="form-control adorable-input" value="{{ old('detalles[0][cantidad]', $envio->detalles[0]['cantidad']) }}" step="1">
                        </div>

                        <div class="form-group">
                            <label for="valor_unidad">Valor por Unidad</label>
                            <input type="number" name="detalles[0][valor_unidad]" id="valor_unidad" class="form-control adorable-input" value="{{ old('detalles[0][valor_unidad]', $envio->detalles[0]['valor_unidad']) }}" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="valor_total">Valor Total</label>
                            <input type="number" name="detalles[0][valor_total]" id="valor_total" class="form-control adorable-input" value="{{ old('detalles[0][valor_total]', $envio->detalles[0]['valor_total']) }}" step="0.01" required>
                        </div>

                        <button type="submit" class="btn adorable-btn btn-dark float-right">Actualizar Envío</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@stop

@section('css')
    <style>
        /* Estilos adorables */
        .adorable-card {
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .adorable-card:hover {
            transform: scale(1.02);
        }

        .adorable-card-header {
            background-color: #d6ecf2;
            border-radius: 15px 15px 0 0;
            padding: 15px;
            text-align: center;
            color: #333;
        }

        .adorable-card-body {
            padding: 20px;
        }

        .adorable-input {
            border-radius: 10px;
            padding: 10px;
        }

        .adorable-btn {
            /*background-color: #ff7f7f;*/
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .adorable-btn:hover {
            background-color: #ff4c4c;
        }

        /* Detalles para que se vean suaves */
        .form-group label {
            font-weight: bold;
            color: #555;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
