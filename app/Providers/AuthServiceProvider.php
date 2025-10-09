<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin", function(User $user){
            return $user->hasRole("admin");
        });
        Gate::define("Gestionnaire de Parc", function(User $user){
            return $user->hasRole("Gestionnaire de Parc");
        });
        Gate::define("Gestionnaire de document", function(User $user){
            return $user->hasRole("Gestionnaire de document");
        });

        Gate::define("Maintenancier", function(User $user){
            return $user->hasRole("Maintenancier");
        });

        Gate::define("Gestionnaire de carburant", function(User $user){
            return $user->hasRole("Gestionnaire de carburant");
        });

        Gate::after(function (User $user) {
            return $user->hasRole("superadmin");
         });
    }
}
