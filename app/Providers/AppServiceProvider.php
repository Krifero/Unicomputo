<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Importa esto

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fuerza el uso de https en producción
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}