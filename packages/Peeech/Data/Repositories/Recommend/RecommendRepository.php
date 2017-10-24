<?php

namespace Peeech\Data\Repositories\Recommend;
use Peeech\Domain\Repositories\Recommend\RecommendRepositoryInterface;
use App\Eloquent\Recommend as Recommend;

class RecommendRepository implements RecommendRepositoryInterface
{
    public function isRecommend(int $user_id)
    {
        return !Recommend::where('user_id',$user_id)->get()->isEmpty();
    }
}


?>