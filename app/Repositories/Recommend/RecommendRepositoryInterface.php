<?php

namespace App\Repositories\Recommend;


interface RecommendRepositoryInterface
{

	public function getRecommendById($id);

	public function getRecommendOnlySettledNullById($id);

}

?>