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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');

Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');

Route::get('/envios', [EnviosController::class, 'index'])->name('envios.index');

Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

Route::get('/roles', [UsuariosController::class, 'index'])->name('roles.index');

