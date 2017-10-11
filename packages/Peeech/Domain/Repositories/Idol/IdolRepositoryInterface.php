<?php

namespace Peeech\Domain\Repositories\Idol;

use App\Eloquent\IdolMaster;
// use Illuminate\Database\Eloquent\Collection;

interface IdolRepositoryInterface
{

    /**
     * add a new idol for a user.
     *
     * @param IdolMaster $idol_master
     */
	public function store(IdolMaster $idol_master);


    /**
     * get idol lists from idol master.
     *
     * 
     * @return EloquentIdolMaster
     */
    public function getAllIdolsFromMaster();

    /**
     * get a idol_master by idol id.
     *
     * @param string $idol
     */
    public function getIdolFromMasterById(Int $idol_id);


}



?>