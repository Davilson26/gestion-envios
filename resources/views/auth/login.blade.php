@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">


@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('title', 'Iniciar Sesión_')

@section('auth_header', __('Ingresa tus credenciales de acceso'))

@section('auth_body')
@section('adminlte_js')
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const loginBox = document.querySelector('.login-box');
    loginBox.classList.add('shake');
    setTimeout(() => {
        loginBox.classList.remove('shake');
    }, 500);
});


// Efecto de enfoque en los campos de entrada
const inputFields = document.querySelectorAll('.form-control');
inputFields.forEach(field => {
    field.addEventListener('focus', function() {
        this.parentNode.classList.add('input-group-focus');
    });
    field.addEventListener('blur', function() {
        this.parentNode.classList.remove('input-group-focus');
    });
});

// Mostrar/ocultar contraseña
const passwordField = document.querySelector('input[name="password"]');
const togglePassword = document.createElement('span');
togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
togglePassword.classList.add('password-toggle');
passwordField.parentNode.appendChild(togglePassword);

togglePassword.addEventListener('click', function() {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    
});

// Animación de carga al enviar el formulario
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ingresando...';
    submitButton.disabled = true;
});
</script>
@stop

@section('adminlte_css')
<style>
body, .login-page {
    background: linear-gradient(5deg, #000000, #1a0000);
}

.login-box {
    background-color: rgba(255, 0, 0, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            transition: all 0.3s ease;
            max-width: 500px;
            width: 100%;
            
}


.login-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 50px rgba(255, 0, 0, 0.4);
}



.login-logo a {
    color: #ff0000;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
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

.input-group-focus .input-group-text {
    color: #ff6666;
}

.input-group-text {
    background-color: transparent;
    border: none;
    color: #ff0000;
}

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

.auth-links a {
    color: #ff6666;
    transition: all 0.3s ease;
}

.auth-links a:hover {
    color: #ff0000;
    text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
}

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
    text-shadow: 0 0 5px rgba(255, 0, 0, 0.5); /* Agrega un efecto de sombra al pasar el mouse */
}


@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake {
    animation: shake 0.5s;
}

</style>
@stop
    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

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

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('Recordarme') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('Ingresar') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    <div class="auth-footer">
        {{-- Password reset link --}}
        @if($password_reset_url)
            <p class="my-0">
                <a href="{{ $password_reset_url }}">
                    {{ __('Olvidé mi contraseña') }}
                </a>
            </p>
        @endif

        {{-- Register link --}}
        @if($register_url)
            <p class="my-0">
                <a href="{{ $register_url }}">
                    {{ __('Registrarme!') }}
                </a>
            </p>
        @endif
    </div>
@stop

