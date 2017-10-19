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

                    $friends = User::where('id',DB::raw("any(select from_user_id from matchings where from_user_id = any(select to_user_id from matchings where from_user_id = $user->id and judge = 1 and settled is null) and to_user_id = $user->id and judge = 1)"))->get();
                    // 配列を操作する際はその配列の要素が１つ以上存在するかチェックしてから

                    if (count($friends) > 0) {
                        foreach($friends as $friend){
                            $matching = Matching::where('from_user_id',$user->id)->where('to_user_id',$friend->id)->first();
                            $matching->settled = 1;
                            $matching->save();
                        }
                        $friends_num = count($friends);
                        $friend_ex = $friends->first();

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