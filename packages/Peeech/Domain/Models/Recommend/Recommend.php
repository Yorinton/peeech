<?php

namespace Peeech\Domain\Models\Recommend;

use Peeech\Domain\Repositories\Recommend\RecommendRepositoryInterface;

class Recommend
{

    private $recommendRepo;

    public function __construct(RecommendRepositoryInterface $recommendRepo)
    {
        $this->recommendRepo = $recommendRepo;
    }

    public function isRecommend(int $user_id): bool
    {
        return $this->recommendRepo->isRecommend($user_id);
    }
}


?>