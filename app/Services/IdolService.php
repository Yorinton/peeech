<?php

namespace App\Services;

use App\Repositories\Idol\IdolRepositoryInterface;
// use App\Repositories\Master\MasterRepositoryInterface;

/**
* 
*/
class IdolService
{
	
	protected $idolRepo;

	function __construct(IdolRepositoryInterface $idolRepo)
	{
		$this->idolRepo = $idolRepo;
	}

    /**
     * add a new idol for a user.
     *
     * @param string $idol_id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function store(Int $idol_id)
	{
		$idol = $this->idolRepo->getIdolMasterById($idol_id);		
		return $this->idolRepo->store($idol);
	}

    /**
     * add some new idols for a user.
     *
     * @param array $idol_ids
     * @return Illuminate\Database\Eloquent\Model
     */
	public function storeMultiple(Array $idol_ids)
	{
		foreach ($idol_ids as $idol_id) {
			$this->store($idol_id);
		}
	}

}


?>