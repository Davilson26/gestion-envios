@extends('adminlte::page')

@section('title', 'OLAGS Ingenieros')

@section('content_header')
<h1>Editar roles del usuario</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success"  id="alert">
    <strong>{{session('info')}}</strong>
</div>
@endif


<div class="card">
    <div class="card-body">
        <p class="h5">Nombre:</p>
        <p class="form-control">{{$usuario->name}}</p>
        
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="h5">Listado de roles</h2>
        @foreach ($roles as $role)
            <div>
                <label for="role_{{ $role->id }}">
                    <input type="radio" name="rol_id" value="{{ $role->id }}" class="mr-1" id="role_{{ $role->id }}"
                        {{ $usuario->rol_id == $role->id ? 'checked' : '' }}>
                    {{ $role->nombre }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-dark float-right">Guardar</button>
        </form>
    </div>
</div>


@section('js')
<script> 
    $(document).ready(function() {
        $('#alert').fadeIn();     
        setTimeout(function() {
            $("#alert").fadeOut();           
        },2000);
    } );
</script>    
@endsection
@stop
