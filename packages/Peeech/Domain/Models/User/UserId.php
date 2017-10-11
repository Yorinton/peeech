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

	public function value(): int
	{
		return $this->value;
	}

}


?>