<?php

namespace App\Providers;

use App\Models\Personas;
use Illuminate\Support\ServiceProvider;
use App\Models\Imagen;
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
     
         // Obtén los datos de la empresa
         $datos = [
         'company'=> Personas::with(['persona_juridicas'])->where('id',1)->first(),
         'imagen' => Imagen::where('imagenable_type', 'App\Models\Personas')
         ->where('imagenable_id',1)->first(),
         ];
         // Comparte los datos con todas las vistas
         view()->share('datos', $datos);
    }
}
