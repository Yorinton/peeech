<?php

namespace Peeech\Data\Repositories\User;

use App\Eloquent\User as EloquentUser;
use Peeech\Domain\Repositories\User\SexRepositoriesInterface;

class SexRepository implements SexRepositoriesInterface
{

	public function registerSex(String $keyOfSex,Int $user_id)
	{
		$user = EloquentUser::where('id',$user_id)->first();
		$user->sex = $keyOfSex;
		$user->save();
	}

	public function getSex(Int $user_id): String
	{
		return EloquentUser::where('id',$user_id)->first()->sex;
	}

}


?>