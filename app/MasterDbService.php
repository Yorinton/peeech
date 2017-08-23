<?php

namespace App;

use App\Repositories\Master\MasterRepository;


class MasterDbService
{

	protected $masterRepository;

	public function __construct(MasterRepository $masterRepository)
	{
		$this->masterRepository = $masterRepository;
	}


	public function getMaster($modelName)
	{
		$string = 'App\\Eloquent\\'.ucfirst($modelName).'Master';
		return $this->masterRepository->getMasterData($string);
	}
}



?>