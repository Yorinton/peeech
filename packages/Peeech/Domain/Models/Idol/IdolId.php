<?php
namespace Peeech\Domain\Models\Idol;


final class IdolId
{
	
	/** @var int */
	private $value;

	/**
	 * @param int $value
	 */

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function value(): int
	{
		return $this->value;
	}
}


?>