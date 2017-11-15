<?php

namespace App\Mail;

use App\Eloquent\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender,int $room_id)
    {
        $this->sender = $sender;
        $this->url = (string)config('app.url').'/room/'.$room_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.messagesent')
//            ->text('emails.messagesent_plain')
                    ->subject('Peeech 新規メッセージが届きました');
    }
}
