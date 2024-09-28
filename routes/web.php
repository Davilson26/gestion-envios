<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EnviosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['roles:1,2,3']) // Suponiendo que 1 es Administrador y 2 es Empleado
    ->group(function () {
        Route::get('/envios/mis-envios', [EnviosController::class, 'sends'])->name('envios.sends')->middleware('auth');
        Route::resource('/envios', EnviosController::class)->names('envios')->middleware('auth');

        Route::resource('/clientes', ClientesController::class)->names('clientes')->middleware('auth');
});

Route::middleware(['roles:1'])->group(function () {
    Route::resource('/usuarios', UsuariosController::class)->names('usuarios')->middleware('auth');
    route::resource('/empleados', EmpleadosController::class)->names('empleados')->middleware('auth');
    Route::resource('/envios', EnviosController::class)->names('envios')->middleware('auth');
});
