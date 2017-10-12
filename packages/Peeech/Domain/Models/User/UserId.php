<?php

namespace Peeech\Domain\Models\User;

/**
* 
*/
final class UserId
{

	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function getUserId(): int
	{
		return (Int)$this->value;
	}

}


?>