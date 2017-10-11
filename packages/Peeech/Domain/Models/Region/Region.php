<?php

namespace Peeech\Domain\Models\Region;


use Peeech\Domain\Repositories\Region\RegionRepositoryInterface;
use App\Eloquent\Region as EloquentRegion;

final class Region
{
	
	/** @var RegionId */
	private $id;

	/** @var RegionName */
	private $region_name;

	/** @var RegionRepositoryInterface */
	public $regionRepo;

	public function __construct(RegionRepositoryInterface $regionRepo)
	{
		$this->regionRepo = $regionRepo;
	}

    /**
     * register a new region for a user.
     *
     * @param RegionName $region_name
     * @return Illuminate\Database\Eloquent\Model
     */
	public function register(RegionName $region_name): EloquentRegion
	{
		return $this->regionRepo->store($region_name);
	}

    /**
     * update region for a user.
     *
     * @param RegionName $region_name
     * @return Illuminate\Database\Eloquent\Model
     */
	public function update(RegionName $region_name): EloquentRegion
	{
		return $this->regionRepo->update($region_name);
	}


}



?>