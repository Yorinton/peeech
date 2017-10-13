<?php

namespace App\Mail;

use App\Eloquent\User as User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MatchingNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 
     * Viewに渡すデータ(friendインスタンス)
     * 
     */
    public $friends_num;//マッチングした人数
    public $friend_ex;//マッチングしたファン友の一人
    public $user;
    public $url;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Int $friends_num,User $friend_ex,User $user)
    {
        //
        $this->friends_num = $friends_num;
        $this->friend_ex = $friend_ex;
        $this->user = $user;
        $this->url = (string)config('app.url').'/matchings/'.$user->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.matched')
                    ->text('emails.matched_plain');
    }
}
