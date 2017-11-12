<?php

namespace Tests\Feature;

use Peeech\Application\Services\Message\MessageReceiver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MessageNotifyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNotify()
    {

        $user = $this->app->make('user')->where('id',83480)->first();
        $this->be($user);

        dd(MessageReceiver::hasNotReadMessage(2));
        $this->assertTrue(true);
    }
}
