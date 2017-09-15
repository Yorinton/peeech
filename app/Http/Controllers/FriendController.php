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
    	// dd(get_class($user));
    	if($user->recommends->where('friend_id',$friend_id)->first()){
    		return $this->show($friend_id);
    	}
    	return 'ご指定の友達は存在しません';
    }
    /**
     * Choose Template of displaying profile (user or friend)
     *
     * @param  array  $datas
     * @return View
     */
    public function chooseTemplate($datas)
    {
        return view('friend',$datas);
    }

}
