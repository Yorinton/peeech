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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender)
    {
        $this->sender = $sender;
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
                    ->subject('Peeech 新規メッセージ！');
    }
}
