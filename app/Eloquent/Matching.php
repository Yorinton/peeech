<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Auth;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Matching extends Model
{

	// use SoftDeletes;

    /**
     * 日付へキャストする属性(ソフトデリート用)
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    //Relation
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function hasMatched($friend_id)
    {
        //Matching済みのユーザーかチェック
        if($matchings = Matching::where('from_user_id',Auth::id())->where('to_user_id',$friend_id)->orWhere('to_user_id',Auth::id())->where('from_user_id',$friend_id)->exists()){

            $matchings = Matching::where('from_user_id',Auth::id())->where('to_user_id',$friend_id)->orWhere('to_user_id',Auth::id())->where('from_user_id',$friend_id)->get();

            foreach ($matchings as $matching) {

                if($matching->judge !== 1){
                    return false;
                }
            }
            return true;
        }
        return false;
    }

}
