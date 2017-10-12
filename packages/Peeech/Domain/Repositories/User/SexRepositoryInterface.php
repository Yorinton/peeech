<?php

namespace Peeech\Domain\Repositories\User;

/**
* 
*/
interface SexRepositoriesInterface
{
	public function registerSex($sex,$user_id);

	public function getSex($user_id);

}

?>