<?php

namespace Peeech\Domain\Models\Idol;

use Peeech\Domain\Repositories\Idol\IdolRepositoryInterface;
use App\Eloquent\Idol as EloquentIdol;
use App\Eloquent\IdolMaster as EloquentIdolMaster;
use Illuminate\Database\Eloquent\Collection;
use Peeech\Domain\Models\User;

/**
* Idol Domain
*/
final class Idol
{
	
	/** @var IdolId */
	private $id;

	/** @var IdolIdLists */
	private $ids;

	/** @var UserId */
	private $user_id;

	/** @var EloquentIdol */
	private $idol;

	/** @var EloquentIdolMaster */
	private $idol_master;

	/** @var IdolRepositoryInterface */
	private $idolRepo;


	public function __construct(IdolRepositoryInterface $idolRepo)
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
     * get idol lists from idol master.
     *
     * 
     * @return EloquentIdolMaster
     */
    public function getAllIdolsFromMaster(): Collection
    {
    	return $this->idolRepo->getAllIdolsFromMaster();
    }

    /**
     * get name of idol from idol master.
     *
     * @param IdolId $id
     * @return EloquentIdolMaster
     */
	private function getIdolFromMasterById(IdolId $id): EloquentIdolMaster
	{
		return $this->idolRepo->getIdolFromMasterById($id->value());	
	}




}



?>