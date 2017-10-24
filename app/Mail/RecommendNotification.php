<?php

namespace App\Mail;

use App\Eloquent\User as User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecommendNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->url = (string)config('app.url').'/friends/'.$user->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.recommended')->subject('Peeech ファン友発見！');
    }
}
