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
		return $this->matching->hasMatched($friend->id);
	}

}


?>