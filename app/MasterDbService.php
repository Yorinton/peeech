<?php

namespace App;

use App\Repositories\Master\MasterRepositoryInterface;


class MasterDbService
{

	protected $masterRepository;

	public function __construct(MasterRepositoryInterface $masterRepository)
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