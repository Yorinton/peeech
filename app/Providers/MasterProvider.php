<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Master\MasterRepository;
use App\MasterDbService;

class MasterProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //MasterRepositoryをバインド
        $this->app->bind('masterRepository',function($app){
            return new MasterRepository();
        });
        $this->app->bind('masterDbService',function($app){
            return new MasterDbService($this->app->make('masterRepository'));
        });
    }
}
