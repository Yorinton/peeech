<?php

namespace App;

use App\Eloquent\Recommend as Recommend;
use App\Eloquent\User as User;
use App\Repositories\Recommend\RecommendRepository;
use App\Repositories\User\UserRepository;


class RecommendService
{

	use Libs\DisplayData;

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
    		$friend->birthday = $this->birthdayFormat($friend->birthday);
    		$friend->sex = $this->sexFormat($friend->sex);
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