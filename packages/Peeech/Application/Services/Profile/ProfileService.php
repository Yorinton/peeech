<?php

namespace Peeech\Application\Services\Profile;

use Peeech\Domain\Models\User\User;


class ProfileService
{
	
	private $profile;

	function __construct(Profile $profile)
	{
		$this->profile = $profile;
	}

	public function showProfile($user_id)
	{
		$profiles = $this->profile->getProfileData($user_id);
		return $this->profile->formatDataforProfile($profiles);
	}


}


?>