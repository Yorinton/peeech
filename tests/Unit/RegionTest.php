<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Peeech\Domain\Models\Region\RegionName;

class RegionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function can_not_use_value_excepting_region_name_const()
    {
    	$pref = '沖縄市';
    	$region_name = new RegionName('沖縄市');
    	// dd($region_name->value());
    	$this->assertEquals($pref,$region_name->value());
    }
}
