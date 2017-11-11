<?php

namespace Peeech\Application\Services\Message;

use App\Eloquent\Room;
use Peeech\Data\Repositories\Message\EloquentMessageRepository;

class MessageReceiver
{
    public static function toHasReadMessage(int $room_id,int $recipient_id)
    {
        //既読テーブルに保存(別途処理をリポジトリに移動する
        $room = Room::where('id',$room_id)->first();
        $messages = $room->messages;
        foreach($messages as $message){
            if($message->user_id === $recipient_id){
                continue;
            }
            if($message->has_read === true){
                continue;
            }
            $message->has_read = true;
            $message->save();
        }
//        $msgRepo = new EloquentMessageRepository;
//        $msgRepo->changeStatus($room_id,$recipient_id);
    }
}