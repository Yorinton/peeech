<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Auth;
use Peeech\Application\Services\Idol\IdolService;
use Peeech\Domain\Models\Idol\Idol;
use Peeech\Domain\Models\Recommend\Recommend;
use Peeech\Domain\Repositories\Idol\IdolRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $is_production = env('APP_ENV') === 'production' ? true : false;
        View::share('is_production',$is_production);
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
        $this->app->bind(Idol::class,function($app){
            return new Idol($this->app->make(IdolRepositoryInterface::class));
        });
        $this->app->bind(IdolService::class,function($app){
            return new IdolService($this->app->make(Idol::class));
        });

    }
}
