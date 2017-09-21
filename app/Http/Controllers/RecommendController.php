<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Eloquent\User as User;
use App\Eloquent\Recommend as Recommend;
use App\Eloquent\Matching as Matching;
use Illuminate\Support\Facades\Auth;
use App\RecommendService;

class RecommendController extends Controller
{

	protected $recommendService;

	public function __construct(RecommendService $recommendService)
	{
		$this->recommendService = $recommendService;
		$this->middleware('auth');
	}
	//今日のファン友候補取得
	public function list($id)
    {
   	    $title = '友達を見つける'; 	
    	if(Auth::id() === (int)$id){
	    	if(Recommend::where('user_id',$id)->exists()){

	    		if(Recommend::where('user_id',$id)->where('settled',null)->exists()){

					$friends = $this->recommendService->getRecommendListsById($id);

			    }else{
			    	return view('friends')->with('title',$title);
			    }
		    	return view('friends')->with('id',$id)
		    						  ->with('friends',$friends)
		    						  ->with('title',$title);
	    	}else {
	    		$m = '該当するファン友候補はまだいません';
	    		return view('friends')->with('m',$m)->with('title',$title);
	    	}
	    }else{
	    	$m = '該当ユーザーは存在しません';
	    	return view('friends')->with('m',$m)->with('title',$title);
	    }
    }
    //興味有りor無し登録
    public function judge(Request $request,$from_user_id)
    {
    	//matchingsテーブルに興味ありなしを登録
    	if(User::findOrfail($from_user_id)->exists()){

			if(!Matching::where('from_user_id',$from_user_id)->where('to_user_id',$request->to_user_id)->exists()){
	    		DB::beginTransaction();
	    		try{

			    	$matchings = new Matching();
			    	$matchings->from_user_id = $from_user_id;
			    	$matchings->to_user_id = $request->to_user_id;
			    	if(isset($request->interest)){
			    		$matchings->judge = 1;
			    	}elseif(isset($request->not_interest)){
			    		$matchings->judge = 0;
			    	}
					$matchings->save();

			    	//recommendsテーブルのsettledにtrueを格納(次回以降レコメンドされないようにする)
			    	$recommend = Recommend::where('user_id',$from_user_id)->where('friend_id',$request->to_user_id)->first();
			    	$recommend->settled = true;
			    	$recommend->save();

			    	DB::commit();
		    	
		    	}catch(\Exception $e){
		    		DB::rollback();
		    	}
		    }
	    	return redirect()->route('friends',['id' => $from_user_id]);
    	}
    }
}







