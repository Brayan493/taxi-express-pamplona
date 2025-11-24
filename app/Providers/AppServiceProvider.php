<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    
    public const HOME = '/dashboard';

    public function register(): void
    {
        // Puedes dejarlo vacío o agregar configuraciones aquí si necesitas
    }

    public function boot(): void
    {
        // Forzar HTTPS en producción
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        $this->configureRedirects();
    }

   
    protected function configureRedirects(): void
    {
        // Tus redirecciones personalizadas aquí
    }
   
}
