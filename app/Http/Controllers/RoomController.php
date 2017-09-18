<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Room;
use App\Eloquent\User;
use App\Eloquent\Matching;
use App\Events\EnterChatRoom;
use Auth;

class RoomController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setRoom(Request $request)
    {
    	if(!Room::where('from_user_id',$request->from_user_id)->where('to_user_id',$request->to_user_id)->orWhere('from_user_id',$request->to_user_id)->where('to_user_id',$request->from_user_id)->exists()){
	    	$room = new Room();
	    	$room->from_user_id = $request->from_user_id;
	    	$room->to_user_id = $request->to_user_id;
	    	$room->save();
    	}else{
            $room = Room::where('from_user_id',$request->from_user_id)->where('to_user_id',$request->to_user_id)->orWhere('from_user_id',$request->to_user_id)->where('to_user_id',$request->from_user_id)->first();
        }
    	return redirect()->route('room',[$room]);
    }

    public function getRoom($room_id)
    {
        $title = 'チャットルーム';
        $user = Auth::user();
        if(Room::where('id',$room_id)->exists()){
            $room = Room::find($room_id);

            if($user->id === $room->from_user_id || $user->id === $room->to_user_id){

                if($user->id === $room->from_user_id){
                    $friend = User::where('id',$room->to_user_id)->first();
                }elseif($user->id === $room->to_user_id) {
                    $friend = User::where('id',$room->from_user_id)->first();
                }

                return view('room')->with('room_id',$room_id)->with('title',$friend->name)->with('user',$user)->with('friend',$friend)->with('backUrl',$_SERVER['HTTP_REFERER']);
            }else {
                return "このルームには参加できません";
            }
        }else {
            return "このルームは存在しません";
        }
    }

    public function show($id)
    {
        $title = 'メッセージ一覧';
        if(Auth::id() === (int)$id){
            if(Room::where('from_user_id',$id)->orWhere('to_user_id',$id)->exists()){
                // ログインユーザーが入室済みのルーム一覧を取得
                $rooms = Room::where('from_user_id',$id)->orWhere('to_user_id',$id)->orderBy('updated_at','desc')->get();

                // 入室済みルームのチャット相手の一覧を取得
                $friends = [];
                foreach ($rooms as $room) {
                    $friend = User::whereNotIn('id',[$id])->where('id',$room->to_user_id)->orWhere('id',$room->from_user_id)->whereNotIn('id',[$id])->first();
                        $friends[] = $friend;
                }
                //roomsのfrom_user_idかto_user_idに自分のidが入っているroomを取得

                if(count($friends) > 0){
                  return view('rooms')->with('friends',$friends)->with('title',$title);
                }
            }
            $m = 'まだメッセージのやり取りはありません';
            return view('rooms')->with('m',$m)->with('title',$title);
        }
        $m = '該当のユーザーは存在しません';
        return view('rooms')->with('m',$m)->with('title',$title);       
    }

}
