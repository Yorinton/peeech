<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use App\Http\Requests;


class ExampleTest extends TestCase
{

	// public function setUp()
	// {

	// }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function testgetMasterTest()
    {
        //MasterDbServiceインスタンス化
        $masterDbService = $this->app->make('masterDbService');
        $this->assertCount(4,$masterDbService->getMaster('purpose'));
    }

    /** @test */
    public function testgetOtherProfsTest()
    {
        //UserServiceインスタンス化(UserやUserRepositoryはUserProvider内でインスタンス化済み)
        $userService = $this->app->make('userService');
    	$this->assertInstanceOf('App\Eloquent\Idol',$userService->getOtherProfs(54,'idols')[0]);
    
    }


}
