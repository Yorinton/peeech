<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Auth;
use Peeech\Domain\Models\Recommend\Recommend;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        $this->app->bind(
            'App\Repositories\Idol\IdolRepositoryInterface',
            'App\Repositories\Idol\IdolRepository'
        );
        $this->app->bind(
            'Peeech\Domain\Repositories\Idol\IdolRepositoryInterface',
            'Peeech\Data\Repositories\Idol\IdolRepository'
        );
        $this->app->bind(
            'Peeech\Domain\Repositories\User\SexRepositoryInterface',
            'Peeech\Data\Repositories\User\SexRepository'
        );
        $this->app->bind(
            'Peeech\Domain\Repositories\Recommend\RecommendRepositoryInterface',
            'Peeech\Data\Repositories\Recommend\RecommendRepository'
        );

    }
}
