<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends UserController
{

    /**
     * Show profile page of friend
     *
     * @param  int $id, int $friend_id
     * @return View
     */
    public function showProfile($id,$friend_id)
    {
    	$user = $this->userService->getUser($id);

    	if(!$user->recommends->where('friend_id',$friend_id)->isEmpty()){
    		return $this->show($friend_id);
    	}
        $m = 'ご指定の友達は存在しません';
    	return view('errors.msg')->with('m',$m);
    }
    /**
     * Choose Template of displaying profile (user or friend)
     *
     * @param  array  $datas
     * @return View
     */
    public function chooseTemplate($datas)
    {
        $datas['hasMatched'] = $this->matchingService->hasMatched($datas['user']);
        $datas['backUrl'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'http://dammie.com';
        $datas['backUrlClass'] = $this->isBackUrl();
        return view('friend',$datas);
    }

    //直前のURLが存在するか(直アクセスでないかどうか)チェック
    public function isBackUrl()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            return 'disblo';
        }
        return 'disnone';
    }

}
