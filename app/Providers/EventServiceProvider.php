<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        // イベント => 注文、リスナ => 注文を通知
        'App\Events\EnterChatRoom' => [
            'App\Listeners\ListenChannel',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //イベントリスナの定義
        Event::listen('event.name', function ($foo, $bar) {
        //
        });
    }
}
