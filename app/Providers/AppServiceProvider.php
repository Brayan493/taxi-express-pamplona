<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Ruta por defecto después del login
     */
    public const HOME = '/dashboard';

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
        // Configuración de redirección después de autenticación
        $this->configureRedirects();
    }

    /**
     * Configurar las redirecciones de autenticación
     */
    protected function configureRedirects(): void
    {
        // Aquí puedes agregar configuración adicional si es necesaria
    }
}