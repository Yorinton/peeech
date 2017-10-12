<?php

namespace Peeech\Domain\Models\User;

/**
* 
*/
class Birthday
{
	
	private $year;

	private $month;

	private $day;

	private $birthdayRepo;

	public function __construct($year,$month,$day,BirthdayRepositoryInterface $birthdayRepo)
	{
		if(!isValidBirthday($year,$month,$day)){
			throw new \InvalidArgumentException('生年月日を入力して下さい');
		}
		$this->birthdayRepo = $birthdayRepo;
		$this->year = $year;
		$this->month = $month;
		$this->day = $day;
	}

	public function isValidBirthday($year,$month,$day)
	{
		return preg_match('[1950-2002]',$year) && preg_match('[1-12]',$month) && preg_match('[1-31]',$day);
	}

	public function getBirthday(UserId $user_id): Birthday
	{
		$birthday = $this->birthdayRepo->getBirthday($user_id);
		return $this->toBirthdayInstance($birthday);
	}

	private function toBirthdayInstance($birthday): Birthday
	{
		$birthArray = explode('-',$birthday);
		return new Birthday($birthArray[0],$birthArray[1],$birthArray[2],$this->birthdayRepo);
	}

	public function formatBirthday(): String
	{
		return (String)implode('-',[$this->year,$this->month,$this->day]);
	}

}

?>