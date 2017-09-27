<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Room;
use App\Eloquent\User;
use App\Eloquent\Matching;
use App\Events\EnterChatRoom;
use Auth;
use App;

class RoomController extends Controller
{
    //
    use App\Libs\DisplayData;

    protected $room;
    protected $title; 

    public function __construct(Room $room)
    {
        $this->room = $room;
        $this->middleware('auth');
    }

    public function setRoom(Request $request)
    {
        if(!$this->room->isRoomByUser($request->from_user_id,$request->to_user_id)){
            $room = $this->room->makeNewRoom($request->from_user_id,$request->to_user_id);
    	}else{
            $room = $this->room->getRoomInfo($request->from_user_id,$request->to_user_id);
        }
    	return redirect()->route('room',[$room]);
    }

    public function showRoom($room_id)
    {
        $user = Auth::user();
        if(!$this->room->isRoomById($room_id)){
            return "このルームは存在しません";
        }
        if(!$this->room->isOwner($user,$room_id)){
            return "このルームには参加できません";
        }
        $friend = $this->room->getChatFriend($user,$room_id);

        //アクセス時間更新
        // $this->room->createAccessTime(Auth::user(),$room_id);
        $this->room->updateAccessTime($user,$room_id);


        return view('room')->with('room_id',$room_id)
                           ->with('title',$friend->name)
                           ->with('user',$user)
                           ->with('friend',$friend)
                           ->with('backUrl',$_SERVER['HTTP_REFERER']);
        
    }

    public function showChatLists($id)
    {
        $this->setTitle('チャット一覧');
        $user = Auth::user();

        if(Auth::id() !== (int)$id){
            $m = '該当のユーザーは存在しません';
            return view('rooms')->with('m',$m)->with('title',$this->title);  
        }

        if(!$this->room->isRoomByUserOneSide($user->id)){
            $m = 'まだメッセージをやり取りしたフレンドはいません';
            return view('rooms')->with('m',$m)->with('title',$this->title);
        }

        $friends = $this->room->getChatFriends($id);

        return view('rooms')->with('friends',$friends)->with('title',$this->title);  
    }

    protected function setTitle($value)
    {
        return $this->title = $value;
    }

}
