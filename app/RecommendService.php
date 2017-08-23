<?php

namespace App;

use App\Eloquent\Recommend as Recommend;
use App\Eloquent\User as User;
use App\Repositories\Recommend\RecommendRepository;
use App\Repositories\User\UserRepository;


class RecommendService
{

	protected $Rrepo;
	protected $Urepo;

	public function __construct(RecommendRepository $Rrepo,UserRepository $Urepo)
	{
		$this->Rrepo = $Rrepo;
		$this->Urepo = $Urepo;
	}

	// Userに関連するモデルのコレクションからUserのリストを生成する(Matchingsでも使えるかも)
	public function collectionsToUserLists($collections,$keyInUser)
	{
		$friends = [];
    	foreach ($collections as $collection) {
    		$friend = $this->Urepo->getUserById($collection->$keyInUser);
    		// $friend = User::where('id',$recommend->friend_id)->first();
    		$friends[] = $friend;
    	}
    	return $friends; 
	}

	public function getRecommendListsById($id)
	{
		$recommends = $this->Rrepo->getRecommendOnlySettledNullById($id);
		// recommendsのfriend_idをキーにUserのリストを生成する
		return $this->collectionsToUserLists($recommends,'friend_id');
	}
}

?>