<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App;

class Room extends Model
{

	use App\Libs\DisplayData;
    //リレーション
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function messages()
    {
    	return $this->hasMany(Message::class);
    }



    //新規ルーム作成
    public function makeNewRoom($from_user_id,$to_user_id)
    {
    	$room = new Room();
    	$room->from_user_id = $from_user_id;
    	$room->to_user_id = $to_user_id;
    	$room->save();

    	return $room;
    }



    //既存ルーム情報の取得
    public function getRoomInfo($from_user_id,$to_user_id)
    {
        $room = Room::where('from_user_id',$from_user_id)->where('to_user_id',$to_user_id)->orWhere('from_user_id',$to_user_id)->where('to_user_id',$from_user_id)->first();

        return $room;	
    }


    //所有するルーム一覧取得
    public function getRooms($id)
    {
    	return Room::where('from_user_id',$id)->orWhere('to_user_id',$id)->orderBy('updated_at','desc')->get();
    }


    //ルームの存在有無をチェック
    public function isRoomByUser($from_user_id,$to_user_id)
    {
    	return Room::where('from_user_id',$from_user_id)->where('to_user_id',$to_user_id)->orWhere('from_user_id',$to_user_id)->where('to_user_id',$from_user_id)->exists();
    }
    public function isRoomById($room_id)
    {
    	return Room::where('id',$room_id)->exists();
    }



    //ルームのオーナーかどうかチェック
    public function isOwner($user,$room_id)
    {
    	$room = $this->findRoomById($room_id);
    	return $user->id === $room->from_user_id || $user->id === $room->to_user_id;
    }



    //チャット相手の取得
    public function getChatFriend($user,$room_id)
    {
    	$room = $this->findRoomById($room_id);

	    if($user->id === $room->from_user_id){
	        return User::where('id',$room->to_user_id)->first();
        }
	    if($user->id === $room->to_user_id) {
	        return User::where('id',$room->from_user_id)->first();
	    }
    }
    //チャットしたことのあるフレンド一覧取得
    public function getChatFriends($user_id)
    {
		$rooms = $this->getRooms($user_id);
        $friends = [];
        foreach ($rooms as $room) {
            $friend = User::whereNotIn('id',[$user_id])->where('id',$room->to_user_id)->orWhere('id',$room->from_user_id)->whereNotIn('id',[$user_id])->first();
                //表示用に整形
                $friend->birthday = $this->birthdayFormat($friend->birthday);
                $friend->sex = $this->sexFormat($friend->sex);
                $friends[] = $friend;
        }
        return $friends;
    }


    //ルームIDからルームを取得
    public function findRoomById($room_id)
    {
    	return Room::findOrFail($room_id);
    }


}
