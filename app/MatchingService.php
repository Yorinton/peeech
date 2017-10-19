<?php

namespace App;

use App\Eloquent\Matching;
use App\Eloquent\User;
use App\Mail\MatchingNotification;
use Mail;
use DB;
/**
* 
*/
class MatchingService
{

	protected $matching;

	public function __construct(Matching $matching)
	{
		$this->matching = $matching;
	}

	public function hasMatched($friend)
	{
		return $this->matching->hasMatched($friend->id);
	}

	public function notifyMatching()
    {
        if(User::all()){
            // 全Userを取得
            $users = User::all();
            foreach ($users as $user) {
                DB::beginTransaction();
                try {
                    $matchings = Matching::where('from_user_id', $user->id)->where('judge', 1)->get();
                    $friends = [];
                    foreach ($matchings as $matching) {
                        if (Matching::where('from_user_id', $matching->to_user_id)->where('to_user_id', $user->id)->where('judge', 1)->exists()) {
                            if ($matching->settled === null) {
                                $friend = User::where('id', $matching->to_user_id)->first();
                                $friends[] = $friend;
                                $matching->settled = true;
                                $matching->save();
                            }
                        }
                    }
                    // 配列を操作する際はその配列の要素が１つ以上存在するかチェックしてから
                    if (count($friends) > 0) {
                        $friends_num = count($friends);
                        $friend_ex = $friends[0];

                        // MatchingNotificationインスタンスの引数にファン友数とファン友の一人のインスタンスと自分のインスタンスを渡す
                        Mail::to(decrypt($user->email))->send(new MatchingNotification($friends_num, $friend_ex, $user));
                    }
                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    echo $e;
                }
            }
        }
    }

}


?>