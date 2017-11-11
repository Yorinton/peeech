<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peeech\Application\Services\Message\MessageReceiver;

class MessageReceiveController extends Controller
{
    public function receive(Request $request)
    {
        //message_recipientsテーブルのhas_readをtrue(1)に
        $room_id = (int)$request->room_id;
        $recipient_id = (int)$request->user_id;

        MessageReceiver::toHasReadMessage($room_id,$recipient_id);
    }

    public function isRead(): bool
    {
        //message_recipientsテーブルのhas_readを取得しtrueかfalseかチェック
    }
}
