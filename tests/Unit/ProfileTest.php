<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Peeech\Domain\Models\Profile\Profile;

class ProfileTest extends TestCase
{

    /** @test */
    public function an_authenticated_user_can_register_profile()
    {
        try{
            //make authenticated user
            $user = $this->app->make('user');
            $user->name = 'より';
            $user->save();
            $this->actingAs($user);

            $profile = new Profile($user->id);
            $profileData = $profile->getProfileData();

            $user->delete();

            dd($profileData);
		}catch(\Exception $e){
			echo $e;
			$user->delete();
		}        
    }
}
