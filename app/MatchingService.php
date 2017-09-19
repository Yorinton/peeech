<?php

namespace App;

use App\Eloquent\Matching;


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
		$friend_id = $friend->id;
		// dd($this->matching->hasMatched($friend_id));
		return $this->matching->hasMatched($friend_id);
	}

}


?>