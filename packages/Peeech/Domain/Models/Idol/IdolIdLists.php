<?php
namespace Peeech\Domain\Models\Idol;

use Peeech\Domain\Models\Idol\IdolId;

final class IdolIdLists
{
	
	/** @var array */
	private $ids;

	/**
	 * @param array $ids
	 */

	public function __construct(Array $ids)
	{
		$ids = $this->toArrayOfIdolId($ids);
		$this->ids = $ids;
	}

	public function value(): array
	{
		return $this->ids;
	}

	private function toArrayOfIdolId(Array $ids)
	{
		$idolIds = [];
		foreach ($ids as $id) {
			if(!is_int($id)){
				throw new InvalidArgumentException('only accepts array of integers.');
			}
			$idolIds[] = $this->toIdolId($id);
		}
		return $idolIds;
	}

	private function toIdolId(int $id)
	{
		return new IdolId($id);
	}
}


?>