<?php

namespace Peeech\Data\Repositories\Idol;

use Peeech\Domain\Repositories\Idol\IdolRepositoryInterface;
use App\Eloquent\Idol;
use App\Eloquent\IdolMaster;
use DB;
use Auth;

class IdolRepository implements IdolRepositoryInterface
{
	
	protected $idol;

	protected $idol_master;

	function __construct(Idol $idol,IdolMaster $idol_master)
	{
		$this->idol = $idol;
		$this->idol_master = $idol_master;
	}

	/**
     * add a new idol for a user.
     *
     * @param IdolMaster $idol_master
     */
	public function store(IdolMaster $idol_master)
	{
		DB::beginTransaction();
		try{

			$idol = $this->idol->newInstance();
			$idol->idol = $idol_master->idol;
			$idol->idol_id = $idol_master->id;
			$idol->user_id = Auth::id();
			$idol->save();
			DB::commit();
			return $idol;

		}catch(\Exception $e){

			DB::rollback();
			return $e;

		}		
	}

    /**
     * get a idol_master by idol_id.
     *
     * @param int $idol_id
     */
    public function getIdolFromMasterById(Int $idol_id): IdolMaster
    {
    	//$idolをキーに$idol_masterを取得
    	return $this->idol_master->where('id',$idol_id)->first();
    }

}



?>