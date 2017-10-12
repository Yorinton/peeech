<?php

namespace Peeech\Domain\Models\User;


class Name
{
	
	private $name;

	private $nameRepo;

	function __construct(String $name,NameRepositoryInterface $nameRepo)
	{
		$this->name = $name;
	}

	public function registerName(UserId $user_id)
	{
		$this->nameRepo->registerName($this->name,$user_id);
	}

	public function getName(UserId $user_id): Name
	{
		return new Name($this->nameRepo->getName($user_id));
	}
}

?>