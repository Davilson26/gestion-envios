@extends('adminlte::page')

@section('title', 'envios')

@section('content_header')
    <h1>envios</h1>
@stop

@section('content')
<div class="row d-flex justify-content-center text-center" style="max-width: 500px; margin: 0 auto;">
    <div class="card border border-dark rounded-3" style="width: 100%; border-radius: 20px;">
        <div class="card-header">
            <h1>Crear envios</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('envios.store') }}" method="POST">
                @csrf

                 <div class="form-group">
                     <label for="origen">Origen</label>
                    <input type="text" name="origen" id="origen" class="form-control" value="{{ old('origen') }}" required>
                </div>

                <div class="form-group">
                 <label for="destino">Destino</label>
                 <input type="text" name="destino" id="destino" class="form-control" value="{{ old('destino') }}" required>
                 </div>

                <div class="form-group">
                 <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
                </div>

                 <div class="form-group">
                    <label for="codigo_envio">Código de Envío (Opcional)</label>
                  <input type="text" name="codigo_envio" id="codigo_envio" class="form-control" value="{{ old('codigo_envio') }}">
                 </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="1">En Proceso</option>
                        <option value="2">Enviado</option>
                     <option value="3">Entregado</option>
                    </select>
                 </div>

                     <!-- Detalles del envío -->
                     <h2>Detalles del Envío</h2>

                    <!-- Sección para agregar múltiples detalles del envío -->
                         <div id="detalles-envio-container">
                             <div class="detalle-envio">
                           <h3>Detalle #1</h3>

                         <div class="form-group">
                            <label for="peso">Peso</label>
                          <input type="number" name="detalles[0][peso]" id="peso" class="form-control" value="{{ old('detalles[0][peso]') }}" step="0.01">
                        </div>

                         <div class="form-group">
                          <label for="alto">Alto</label>
                         <input type="number" name="detalles[0][alto]" id="alto" class="form-control" value="{{ old('detalles[0][alto]') }}" step="0.01">
                          </div>

                        <div class="form-group">
                           <label for="ancho">Ancho</label>
                       <input type="number" name="detalles[0][ancho]" id="ancho" class="form-control" value="{{ old('detalles[0][ancho]') }}" step="0.01">
                     </div>

                     <div class="form-group">
                        <label for="profundidad">Profundidad</label>
                          <input type="number" name="detalles[0][profundidad]" id="profundidad" class="form-control" value="{{ old('detalles[0][profundidad]') }}" step="0.01">
                     </div>

                     <div class="form-group">
                      <label for="cantidad">Cantidad</label>
                      <input type="number" name="detalles[0][cantidad]" id="cantidad" class="form-control" value="{{ old('detalles[0][cantidad]') }}" step="1">
                     </div>

                    <div class="form-group">
                        <label for="valor_unidad">Valor por Unidad</label>
                      <input type="number" name="detalles[0][valor_unidad]" id="valor_unidad" class="form-control" value="{{ old('detalles[0][valor_unidad]') }}" step="0.01">
                    </div>

                     <div class="form-group">
                     <label for="valor_total">Valor Total</label>
                     <input type="number" name="detalles[0][valor_total]" id="valor_total" class="form-control" value="{{ old('detalles[0][valor_total]') }}" step="0.01" required>
                    </div>

                     

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
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
