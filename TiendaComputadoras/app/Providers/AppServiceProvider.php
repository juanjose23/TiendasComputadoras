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
       $empresa = [
            'company' => Personas::with(['persona_juridicas'])->where('id', 1)->first(),
            'imagen' => Imagen::where('imagenable_type', 'App\Models\Personas')
                              ->where('imagenable_id', 1)
                              ->first() ?? null,
        ];
      
        // Comparte los datos con todas las vis*tas
        view()->share('empresa', $empresa);
    }
}
