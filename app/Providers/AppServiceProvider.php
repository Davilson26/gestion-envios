<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Gate para el rol Administrador
        Gate::define('es-admin', function ($user) {
            return $user->rol_id === 1; // Suponiendo que 1 es el ID de Administrador
        });

        // Gate para el rol Empleado
        Gate::define('es-empleado', function ($user) {
            return $user->rol_id === 2; // Suponiendo que 2 es el ID de Empleado
        });

        // Gate para el rol Cliente
        Gate::define('es-cliente', function ($user) {
            return $user->rol_id === 3; // Suponiendo que 3 es el ID de Cliente
        });
    }
}
