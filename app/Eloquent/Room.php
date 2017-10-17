<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App;
use Auth;

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
    public function access_to_rooms()
    {
        return $this->hasMany(AccessToRoom::class);
    }



    //新規ルーム作成
    public function makeNewRoom($from_user_id,$to_user_id)
    {
    	$room = new Room();
    	$room->from_user_id = $from_user_id;
    	$room->to_user_id = $to_user_id;
    	$room->save();

        $this->createAccessTime(Auth::user(),$room->id);

    	return $room;
    }



    //既存ルーム情報の取得
    public function getRoomInfo($from_user_id,$to_user_id)
    {
        $room = Room::where('from_user_id',$from_user_id)->where('to_user_id',$to_user_id)->orWhere('from_user_id',$to_user_id)->where('to_user_id',$from_user_id)->first();

        $this->updateAccessTime(Auth::user(),$room->id);

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
    public function isRoomByUserOneSide($user_id)
    {
        return Room::where('from_user_id',$user_id)->orWhere('to_user_id',$user_id)->exists();
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
                $isMessagesUpdated = $this->isNonReadMessages($friend,$room->id);
                $friends[] = ['user' => $friend,'isNonReadMessages' => $isMessagesUpdated];
        }
        return $friends;
    }


    //ルームIDからルームを取得
    public function findRoomById($room_id)
    {
    	return Room::findOrFail($room_id);
    }


    //ユーザーがルームにアクセスした時間を記録
    public function createAccessTime(User $user,$room_id)
    {
        $access_to_room = new AccessToRoom;
        $access_to_room->room_id = $room_id;
        $access_to_room->user_id = $user->id;
        $access_to_room->save();
    }


    //ユーザーがルームにアクセスした時間を更新
    public function updateAccessTime(User $user,$room_id)
    {
        AccessToRoom::where('user_id',$user->id)->where('room_id',$room_id)->update(['room_id' => $room_id]);
    }


    //直近のアクセス時間を取得
    public function getLatestAccessTime($room_id)
    {
        return $access_to_room = AccessToRoom::where('user_id',Auth::id())->where('room_id',$room_id)->first()->updated_at->timestamp;
    }

    //AccessTimeが記録されているか
    public function isAccessTime(User $user,$room_id)
    {
        return AccessToRoom::where('user_id',$user->id)->where('room_id',$room_id)->exists();
    }


    //メッセージはアップデートされているか
    public function isNonReadMessages(User $friend,$room_id)
    {
        if($friend->messages->isEmpty()){
            return '';
        }
        if(!$this->isAccessTime(Auth::user(),$room_id)){
            return '';
        }
        $latestMessageUpdate = $friend->messages()->latest()->first()->updated_at->timestamp;
        $latestAccessTime = $this->getLatestAccessTime($room_id);
        return $latestMessageUpdate > $latestAccessTime ? '●' : '';
    }

}
