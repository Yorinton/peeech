<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Eloquent\User as User;
use App\Repositories\User\UserRepository;
use App\Services\UserService;

class UserProvider extends ServiceProvider
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

        //Userをバインド
        $this->app->bind('user',function($app){
            return new User();
        });

        //UserRepositoryをバインド
        $this->app->bind('userRepo',function($app){
            return new UserRepository($this->app->make('user'));
        });

        //UserServiceをバインド
        $this->app->bind('userService',function($app){
            return new userService($this->app->make('userRepo'));
        }); 

        // UserRepositoryInterfaceの実装をUserRepositoryに設定。変更する場合はここを変更する
        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository'
        );
    }
}
