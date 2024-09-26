@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') )

@if (config('adminlte.use_route_url', false))
    @php( $password_email_url = $password_email_url ? route($password_email_url) : '' )
@else
    @php( $password_email_url = $password_email_url ? url($password_email_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.password_reset_message'))

@section('auth_body')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ $password_email_url }}" method="post">
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

        {{-- Send reset link button --}}
        <button type="submit" class="btn btn-block btn-danger" style="border-radius: 20px;">
            <span class="fas fa-share-square"></span>
            {{ __('adminlte::adminlte.send_password_reset_link') }}
        </button>

    </form>

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

.input-group .form-control {
    border: none;
    border-bottom: 2px solid #ff0000;
    background-color: rgba(225, 225, 225, 0.5);
    color: #000 !important; /* Cambiar a negro con !important */
    transition: all 0.3s ease;
}

.input-group .form-control:focus {
    box-shadow: none;
    border-bottom-color: #ff6666;
    background-color: rgba(255, 255, 255, 0.2);
}

.input-group-text {
    background-color: transparent;
    border: none;
    color: #ff0000;
}

.alert-success {
    background-color: rgba(255, 0, 0, 0.1);
    color: #ff0000; /* Cambiar color del texto a rojo */
}
</style>
@stop
    