<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\RecommendService;

class RecommendTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsRecommend()
    {
        $user_id = 1;
        $recommend = $this->app->make('Peeech\Domain\Models\Recommend\Recommend');
        $isRecommend = $recommend->isRecommend($user_id);
        $this->assertTrue($isRecommend);
    }

    public function testNotBeRecommend()
    {
        $user_id = 7;
        $recommend = $this->app->make('Peeech\Domain\Models\Recommend\Recommend');
        $isRecommend = $recommend->isRecommend($user_id);
        $this->assertTrue(!$isRecommend);
    }

    public function testRecommendService()
    {
        $user_id = 1;
        $this->assertTrue(RecommendService::isRecommend($user_id));
        $this->assertEquals('../../images/services/recommend_finish.png',RecommendService::recommendImagePath($user_id));

        $user_id = 7;
        $this->assertTrue(!RecommendService::isRecommend($user_id));
        $this->assertEquals('../../images/services/recommend_before.png',RecommendService::recommendImagePath($user_id));

    }
}
