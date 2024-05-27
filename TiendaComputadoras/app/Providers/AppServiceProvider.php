<?php

namespace App\Providers;

use App\Models\Personas;
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
       ///
         // Obtén los datos de la empresa
         $company = Personas::first();

         // Comparte los datos con todas las vistas
         view()->share('company', $company);
    }
}
