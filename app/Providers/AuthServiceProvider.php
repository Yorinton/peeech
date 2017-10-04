<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Idol::class => IdolPolicy::class,
        Favorite::class => FavoritePolicy::class,
        Statue::class => StatuePolicy::class,
        Region::class => RegionPolicy::class,
        Purpose::class => PurposePolicy::class,
        Event::class => EventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-user',function($user){
            return $user->id = Auth::id();
        });
        
    }
}
