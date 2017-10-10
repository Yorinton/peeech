<?php

namespace Peeech\Domain\Models\Idol;

use Peeech\Domain\Repositories\Idol\IdolRepositoryInterface;
use App\Eloquent\Idol as EloquentIdol;
use App\Eloquent\IdolMaster as EloquentIdolMaster;

/**
* Idol Domain
*/
final class Idol
{
	
	/** @var IdolId */
	private $id;

	/** @var IdolIdLists */
	private $ids;

	/** @var IdolMaster */
	private $idol_master;

	/** @var IdolRepositoryInterface */
	protected $idolRepo;


	function __construct(IdolRepositoryInterface $idolRepo)
	{
		$this->idolRepo = $idolRepo;
	}

    /**
     * add a new idol for a user.
     *
     * @param string $id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function add(IdolId $id): EloquentIdol
	{
		$this->idol_master = $this->getIdolFromMasterById($id);			
		return $this->idolRepo->store($this->idol_master);
	}

    /**
     * add some new idols for a user.
     *
     * @param array $ids
     * @return void
     */
	public function addMultiple(IdolIdLists $ids)
	{
		foreach ($ids->value() as $id) {
			$this->add($id);
		}
	}

    /**
     * get name of idol from idol master.
     *
     * @param IdolId $id
     * @return String
     */
	private function getIdolFromMasterById(IdolId $id): EloquentIdolMaster
	{
		return $this->idolRepo->getIdolFromMasterById($id->value());	
	}


}



?>