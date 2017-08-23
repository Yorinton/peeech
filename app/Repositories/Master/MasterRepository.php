<?php

namespace App\Repositories\Master;

use App\Eloquent;

class MasterRepository implements MasterRepositoryInterface
{
	public function getMasterData($string)
	{
        return $string::all();
	}

}


?>