<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Eloquent\User;

use App\Mail\MatchingNotification;
use Illuminate\Support\Facades\Mail;

class MailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function send_mail_to_test_address()
    {
    	$friends_num = 3;
    	$friend_ex = User::where('id',3)->first();
    	$user = User::where('id',2)->first();
        Mail::to('sansan106700@gmail.com')->send(new MatchingNotification($friends_num,$friend_ex,$user));
    }
}