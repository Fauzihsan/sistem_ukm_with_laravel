<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('isSuperAdmin', function(User $user){
            return $user->roles_id == 1;
        });
        Gate::define('isBaak', function(User $user){
            return $user->roles_id == 2;
        });
        Gate::define('isDekan', function(User $user){
            return $user->roles_id == 3;
        });
        Gate::define('isWakilDekan', function(User $user){
            return $user->roles_id == 4;
        });
        Gate::define('isPembimbing', function(User $user){
            return $user->roles_id == 5;
        });
        Gate::define('isBlm', function(User $user){
            return $user->roles_id == 6;
        });
        Gate::define('isBem', function(User $user){
            return $user->roles_id == 7;
        });
        Gate::define('isUkm', function(User $user){
            return $user->roles_id == 8;
        });
    }
}
