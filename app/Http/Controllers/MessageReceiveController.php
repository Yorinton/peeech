<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peeech\Application\Services\Message\MessageReceiver;

class MessageReceiveController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function receive(Request $request)
    {
        $room_id = (int)$request->room_id;
        $recipient_id = (int)$request->user_id;

        return MessageReceiver::toHasReadMessage($room_id,$recipient_id);
    }

    public function notify(Request $request)
    {
        $room_id = (int)$request->room_id;
        $sender_id = (int)$request->user_id;

        return MessageReceiver::sendMessageNotification($room_id,$sender_id);
    }

}
