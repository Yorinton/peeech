<?php

namespace App\Repositories\Recommend;

use App\Eloquent\Recommend;

/**
* 
*/
class RecommendRepository implements RecommendRepositoryInterface
{
	
	protected $recommend;

	function __construct(Recommend $recommend)
	{
		$this->recommend = $recommend;
	}

	public function getRecommendById($id)
	{
		return $this->recommend->where('user_id',$id)->get();
	}

	public function getRecommendOnlySettledNullById($id)
	{
		return $this->getRecommendById($id)->where('settled',null);
	}

}


?>