<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Libs\DisplayData;

class BirthdayToAgeTest extends TestCase
{
    use DisplayData;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBirthdayToAge()
    {

        $age = $this->birthdayFormat('1987-10-27');
        $this->assertEquals('30歳',$age);
    }
}
