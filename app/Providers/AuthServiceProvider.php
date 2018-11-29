<?php

namespace App\Providers;

use App\Fictionary\Auth\User;
use App\Fictionary\Profiles\Profile;
use App\Fictionary\Auth\Policies\UserPolicy;
use App\Fictionary\Profiles\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
