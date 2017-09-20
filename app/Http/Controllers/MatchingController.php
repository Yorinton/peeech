<?php

namespace App\Http\Controllers;

use App\Eloquent\User as User;
use App\Eloquent\Matching as Matching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

class MatchingController extends Controller
{

    use App\Libs\DisplayData;

    protected $title;
    protected $matching;

    public function __construct(Matching $matching)
    {
        $this->matching = $matching;
        $this->middleware('auth');
    }

    public function showMatchedFriends($id)
    {
        if(Auth::id() !== (int)$id){
            $m = '該当のユーザーは存在しません';
            return view('matchings')->with('m',$m)->with('title',$this->title);
        }

        $this->setTitle('マッチング一覧');
        $friends = $this->matching->getMatchedFriends($id);

        if(count($friends) <= 0){
            $m = 'まだマッチングしたファン友はいません';
            return view('matchings')->with('m',$m)->with('title',$this->title);
        }

        return view('matchings')->with('friends',$friends)->with('title',$this->title);
    }

    protected function setTitle($value)
    {
        return $this->title = $value;
    }
}
