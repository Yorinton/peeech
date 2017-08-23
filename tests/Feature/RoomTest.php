<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoomTest extends TestCase
{
   //  public function an_authenticated_user_can_create_room()
   //  {
   //  	$user = $this->app->make('user')->where('id',54)->first();
 		// $this->be($user);

 		// $request = [
 		// 	'from_user_id' => $user->id,
 		// 	'to_user_id' => 57
 		// ];
 		// $this->post('/room',$request);

 		// $room = $user->rooms()->where('from_user_id',$user->id)->first();
 		// $this->assertEquals($user->id,$room->from_user_id);
 		// $room->delete();
   //  }

   //  /** @test */
   //  public function an_authenticated_user_can_join_room_of_own()
   //  {
   //  	$user = $this->app->make('user')->where('id',54)->first();
 		// $this->be($user);

 		// $request = [
 		// 	'from_user_id' => $user->id,
 		// 	'to_user_id' => 57
 		// ];
 		// $this->post('/room',$request);

 		// $room = $user->rooms()->where('from_user_id',$user->id)->first();
 		// $this->get('/room'.$room->id)
 		// 	 ->assertStatus(200);
 		// $room->delete();
   //  }
}
