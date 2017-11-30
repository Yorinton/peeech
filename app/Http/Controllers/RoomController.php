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
    protected $is_production;


    public function __construct(Room $room)
    {
        $this->room = $room;
        $this->middleware('auth');
        $this->is_production = env('APP_ENV') === 'production' ? true : false;
    }


    public function setRoom(Request $request)
    {
        if(!$this->room->isRoomByUser($request->from_user_id,$request->to_user_id)){
            $room = $this->room->makeNewRoom($request->from_user_id,$request->to_user_id);
    	}else{
            $room = $this->room->getRoomInfo($request->from_user_id,$request->to_user_id);
        }
//    	return redirect()->route('room',[$room]);
        return redirect('/room/'.$room->id,302,[],$this->is_production);
    }


    public function showRoom($room_id)
    {
        $user = Auth::user();
        //戻るのリンク先
        $backUrl = $this->BackUrl();

        if(!$this->room->isRoomById($room_id)){
            $m = "このルームは存在しません";
            return view('room')->with('m',$m)->with('backUrl',$backUrl);
        }
        if(!$this->room->isOwner($user,$room_id)){
            $m = "このルームには参加できません";
            return view('room')->with('m',$m)->with('backUrl',$backUrl);
        }
        $friend = $this->room->getChatFriend($user,$room_id);

        //アクセス時間更新
        if(!$this->room->isAccessTime($user,$room_id)){
            $this->room->createAccessTime($user,$room_id);
        }else{
            $this->room->updateAccessTime($user,$room_id);
        }

        return view('room')->with('room_id',$room_id)
                           ->with('title',$friend->name)
                           ->with('user',$user)
                           ->with('friend',$friend)
                           ->with('backUrl',$backUrl);
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

    //直前のURLが存在するか(直アクセスでないかどうか)チェック
    private function BackUrl(): array
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            return ['url' => $_SERVER['HTTP_REFERER'],'class' => 'disblo'];
        }
        return ['url' => '','class' => 'disnone'];
    }

}
