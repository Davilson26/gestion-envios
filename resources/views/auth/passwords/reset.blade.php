@extends('adminlte::auth.auth-page', ['auth_type' => 'reset-password'])

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('title', 'Restablecer mi contraseña')

@section('auth_header', __('Restablecer mi contraseña'))

@section('auth_body')
    <form action="{{ $password_reset_url }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

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

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">

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

        <button type="submit" class="btn btn-block btn-danger" style="border-radius: 20px;">
            <span class="fas fa-sync-alt"></span>
            {{ __('adminlte::adminlte.reset_password') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}" style="color: #ff0000;">
            {{ __('Ya tengo una cuenta') }}
        </a>
    </p>
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
</style>
@stop
