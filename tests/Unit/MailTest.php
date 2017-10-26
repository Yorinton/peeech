<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Eloquent\User;

use App\Mail\MatchingNotification;
use App\Mail\RecommendNotification;
use Illuminate\Support\Facades\Mail;

class MailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function testMatchedNotification()
    {
    	$friends_num = 3;
    	$friend_ex = User::where('id',6)->first();
    	$user = User::where('id',83471)->first();
        Mail::to(decrypt($user->email))->send(new MatchingNotification($friends_num,$friend_ex,$user));
        $this->assertTrue(true);
    }

    public function testRecommendNotification()
    {
        $user = User::where('id',83471)->first();
        Mail::to(decrypt($user->email))->send(new RecommendNotification($user));
        $this->assertTrue(true);
    }
}
