<?php

namespace Peeech\Domain\Models\User;


class Sex
{

	private $keyOfSex;

	private $sex;

	private $sexRepo;

	const SEX = [
		'male' => '男性',
		'female' => '女性',
	];

	public function __construct($key,SexRepositoryInterface $sexRepo)
	{
		if(!$this->isValidKey($key)){
			throw new \InvalidArgumentException('性別を指定して下さい');
		}
		$this->keyOfSex = $key;
		$this->sex = self::SEX[$key];
		$this->sexRepo = $sexRepo;
	}

	final private function isValidKey($key): boolean
	{
		return array_key_exists($key, self::SEX);
	}

	final public function registerSex(UserId $user_id)
	{
		$this->sexRepo->registerSex($this->keyOfSex,$user_id->getUserId());
	}

	final static public function getSex(UserId $user_id): Sex
	{
		return new Sex($this->sexRepo->getSex($user_id->getUserId()));
	}

}

?>