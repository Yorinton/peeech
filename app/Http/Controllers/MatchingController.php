<?php

namespace App\Http\Controllers;

use App\Eloquent\User as User;
use App\Eloquent\Matching as Matching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function show($id)
    {
        $title = 'マッチング一覧';
        if(Auth::id() === (int)$id){
        	if(Matching::where('from_user_id',$id)->where('judge',1)->exists()){
    	    	$matchings = Matching::where('from_user_id',$id)->where('judge',1)->get();
    	    	$friends = [];
    	    	foreach ($matchings as $matching) {
                    if(Matching::where('from_user_id',$matching->to_user_id)->where('to_user_id',$matching->from_user_id)->where('judge',1)->exists()){
                        $friend = User::where('id',$matching->to_user_id)->first();
                        $friends[] = $friend;
                    }
    	    	}
                if(count($friends) > 0){
        		  return view('matchings')->with('friends',$friends)->with('title',$title);
                }
        	}
        	$m = 'まだマッチングしたファン友はいません';
        	return view('matchings')->with('m',$m)->with('title',$title);
        }
        $m = '該当のユーザーは存在しません';
        return view('matchings')->with('m',$m)->with('title',$title);
    }
}
