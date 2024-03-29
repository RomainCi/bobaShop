<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('payment', function (User $user, int $id): bool {
            return $user->orders->whereNotIn('status', ['succeeded'])->contains('id', $id);
        });

        Gate::define('information', function (User $user, int $id): bool {
            return $user->id === $id;
        });

        Gate::define('response', function (User $user, int $id): bool {
            return $user->orders->contains('id', $id);
        });

    }
}
