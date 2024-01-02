<?php

namespace App\Providers;

use App\Models\Nfe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isNfeOwner', function (User $user, Nfe $nfe) {
            return $user->id === $nfe->user_id ?  Response::allow() : Response::deny('You must be a NFE owner');
        });
    }
}
