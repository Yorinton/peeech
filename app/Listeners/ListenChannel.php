<?php

namespace App\Listeners;

use App\Events\EnterChatRoom;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListenChannel
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EnterChatRoom  $event
     * @return void
     */
    public function handle(EnterChatRoom $event)
    {
        //
    }
}
