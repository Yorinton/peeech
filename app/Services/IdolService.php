<?php

namespace App\Services;

use Peeech\Domain\Models\Idol\Idol;
use Peeech\Domain\Models\Idol\IdolId;
/**
* 
*/
class IdolService
{
	
	protected $idol;

	function __construct(Idol $idol)
	{
		$this->idol = $idol;
	}
    /**
     * add a new idol for a user.
     *
     * @param string $idol_id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function store(int $idol_id)
	{
		return $this->idol->add(new IdolId($idol_id));
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