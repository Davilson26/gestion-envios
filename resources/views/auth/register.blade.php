@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('title', 'Registrarme')

@section('auth_header', __('Registrarme!'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('Nombre') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('Confirmar password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Default role field --}}
        <div class="input-group mb-3">
            <input type="hidden" name="rol_id" value="3" class="form-control" readOnly>
        </div>


        {{-- Register button --}}
        <button type="submit" class="btn btn-block">
            <span class="fas fa-user-plus"></span>
            {{ __('Registrarme') }}
        </button>

    </form>
@stop
@section('adminlte_css')
<style>
    /* Fondo degradado del cuerpo y la página */
    body, .register-page {
        background: linear-gradient(5deg, #000000, #1a0000);
    }

    /* Caja del formulario de registro */
    .register-box {
        background-color: rgba(255, 0, 0, 0.1);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
        transition: all 0.3s ease;
        max-width: 500px;
        width: 100%;
    }

    .register-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 50px rgba(255, 0, 0, 0.4);
    }

    /* Logo del formulario */
    .register-logo a {
        color: #ff0000;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Campos de entrada */
    .input-group .form-control {
        border: none;
        border-bottom: 2px solid #ff0000;
        background-color: rgba(225, 225, 225, 0.5);
        color: #fff;
        transition: all 0.3s ease;
    }

    .input-group .form-control:focus {
        box-shadow: none;
        border-bottom-color: #ff6666;
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* Estilo para iconos de los campos */
    .input-group-focus .input-group-text {
        color: #ff6666;
    }

    .input-group-text {
        background-color: transparent;
        border: none;
        color: #ff0000;
    }

    /* Botón de registro */
    .btn-block {
    width: 100%;
    padding: 12px 20px;
    border: none;
    background-color: #ff0000;
    color: #fff;
    font-size: 18px;
    border-radius: 30px; /* Aumenta el redondeado */
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3); /* Agrega una sombra suave */
}

.btn-block:hover, .btn-block:focus {
    background: linear-gradient(45deg, #cc0000, #990000);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4); /* Sombra más profunda al pasar el mouse */
}

    /* Links de la parte inferior del formulario */
    .auth-links a {
        color: #ff6666;
        transition: all 0.3s ease;
    }

    .auth-links a:hover {
        color: #ff0000;
        text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
    }
    .input-group .form-control {
    border: none;
    border-bottom: 2px solid #ff0000;
    background-color: rgba(225, 225, 225, 0.5);
    color: #ff6666; /* Cambiar el color del texto a negro */
    transition: all 0.3s ease;
}

.input-group .form-control:focus {
    box-shadow: none;
    border-bottom-color: #ff6666;
    background-color: rgba(255, 255, 255, 0.2);
    color: #ff6666; /* Mantener el texto negro al hacer focus */
}


    /* Icono para mostrar/ocultar contraseña */
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #000000;
    }
    .auth-footer a {
    color: #ff0000; /* Cambia el color del enlace a rojo */
    transition: all 0.3s ease;
}

.auth-footer a:hover {
    color: #cc0000; /* Color más oscuro al pasar el mouse */
    text-shadow: 0 0 5px rgba(255, 0, 0, 0.5); /* Efecto de sombra al pasar el mouse */
}

</style>
@section('auth_footer')
    <div class="auth-footer">
        <p class="my-0">
            <a href="{{ $login_url }}">
                {{ __('Ya tengo una cuenta') }}
            </a>
        </p>
    </div>
@stop

@stop



