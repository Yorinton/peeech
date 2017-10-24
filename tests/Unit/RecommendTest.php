<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


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
}
