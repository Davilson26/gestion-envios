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

// Route::group(['middleware' => 'checkRole:clientes'], function () {
// Route::get('/envios', [EnviosController::class, 'index'])->name('envios.index');
// });


Route::resource('/clientes', ClientesController::class)->names('clientes')->middleware('auth');
Route::resource('/envios', EnviosController::class)->names('envios')->middleware('auth');

Route::resource('/usuarios', UsuariosController::class)->names('usuarios')->middleware('auth');

Route::get('/roles', [UsuariosController::class, 'index'])->name('roles.index')->middleware('auth');

route::resource('/empleados', EmpleadosController::class)->names('empleados')->middleware('auth');