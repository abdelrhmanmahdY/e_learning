<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Rolegroup;
use App\Models\User;
use App\Policies\RoleGroupPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();


        // Example of another gate
        Gate::define('isAdmin', function (User $user, rolegroup $roleGroup) {

            return $user->id === $roleGroup->user_id || $user->hasRole('admin');
        });
    }
}
