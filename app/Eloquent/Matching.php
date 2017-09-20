<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Matching extends Model
{

	// use SoftDeletes;
    use App\Libs\DisplayData;
    /**
     * 日付へキャストする属性(ソフトデリート用)
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class,'to_user_id');
    }


    //マッチングした友達全員取得
    public function getMatchedFriends($id)
    {
        $friends = [];
        if(!$this->hasInterestingUser()){
            dd($friends);
            return $friends;
        }
        $matchings = Matching::where('from_user_id',$id)->where('judge',1)->get();
        foreach ($matchings as $matching) {
            if($this->isInterestedByFriend($matching->to_user_id)){
                $friend = $matching->user;
                // User::where('id',$matching->to_user_id)->first();
                //表示用に整形
                $friend->birthday = $this->birthdayFormat($friend->birthday);
                $friend->sex = $this->sexFormat($friend->sex);
                $friends[] = $friend;
            }
        }
        return $friends;
    }


    //自分が興味有りしたかチェック
    public function hasInterestingUser()
    {
        $user = Auth::user();
        return !$user->matchings->where('judge',1)->isEmpty();
    }
    //自分が興味ありされたかチェック
    public function isInterestedByFriend($friend_id)
    {
        return Matching::where('from_user_id',$friend_id)->where('to_user_id',Auth::id())->where('judge',1)->exists();
    }
    //特定のユーザーとマッチングしたかチェック
    public function hasMatched($friend_id)
    {
        if(!$this->hasInterestingUser()){
            return false;
        }
        $matchings = Matching::where('from_user_id',Auth::id())
                             ->where('to_user_id',$friend_id)
                             ->where('judge',1)->get();
        foreach($matchings as $matching){
            if($this->isInterestedByFriend($matching->to_user_id)){
                return true;
            }
        }
        return false;
    }
}
