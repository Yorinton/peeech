<?php

namespace Peeech\Domain\Models\Profile;

use Peeech\Domain\Models\User\UserId;
use Peeech\Domain\Models\User\Sex;

// use Peeech\Domain\Models\Idol;
// use Peeech\Domain\Models\Region;

/**
* 
*/
class Profile
{
	
	/** @var ProfileLists */
	private $profile_lists;

	/** @var UserId */
	private $user_id;

	public function __construct($user_id)
	{
		$this->user_id = new UserId($user_id);
	}

	public function getProfileData()
	{
		$profileDatas = [];
		foreach (ProfileLists::PROFILELISTS as $profile) {
			$class = ucfirst($profile);//クラス名に変換
			$method = "get".$class;
			$profileDatas[] = $class::$method($this->user_id);
		}
		return $profileDatas;
	}

	// public function formatDataforProfile($profiles)
	// {

	// }




}

?>