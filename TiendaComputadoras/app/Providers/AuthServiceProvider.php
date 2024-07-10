<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Solicitud_compra;
use App\Policies\SolicitudPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Solicitud_compra::class =>SolicitudPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

       
    }
}
