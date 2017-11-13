<?php

namespace Peeech\Application\Services\Message;

use App\Eloquent\Message;
use App\Eloquent\Room;
use App\Eloquent\User;
use App\Mail\MessageNotification;
use Mail;
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
        return ['roomId' => $room_id,'recipientId' => $recipient_id];
//        $msgRepo = new EloquentMessageRepository;
//        $msgRepo->changeStatus($room_id,$recipient_id);

    }

    public static function sendMessageNotification(int $room_id,int $sender_id)
    {
        if($room = Room::where('from_user_id',$sender_id)->first()){
            $receiver = User::where('id',$room->to_user_id)->first();
        }elseif($room = Room::where('to_user_id',$sender_id)->first()){
            $receiver = User::where('id',$room->from_user_id)->first();
        }
        if(self::hasNotReadMessage($room_id,$sender_id)) {
            //リポジトリに移す
            Mail::to(decrypt($receiver->email))->send(new MessageNotification(self::getSender($sender_id)));
            //messagesのnotifiedカラムをtrueにする
            $messages = Message::where('room_id',$room_id)->where('user_id',$sender_id)->get();
            foreach($messages as $message) {
                $message->notified = 1;
                $message->save();
            }

            return ['result' => '送信'];
        }
        return ['result' => '未送信'];
    }

    private static function hasNotReadMessage(int $room_id,int $sender_id): bool
    {
         //notifiedカラムがfalseの場合を条件に加える
         $sentMessage = Message::where('room_id',$room_id)
                                ->where('user_id',$sender_id)
                                ->latest()
                                ->first();
         if(!$sentMessage){
             return false;
         }
         return $sentMessage->has_read === 0 && $sentMessage->notified === 0;
    }

    private static function getSender(int $sender_id)
    {
        return User::find($sender_id);
    }
}