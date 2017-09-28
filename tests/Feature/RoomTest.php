<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Eloquent\Room;
use App\Eloquent\Message;
use App\Eloquent\User;

class RoomTest extends TestCase
{

	/*
	* 
	* Room
	*
	*/
	/** @test */
	public function an_authenticated_user_can_make_chatroom()
    {
    	$user = $this->app->make('user');

    }

	/*
	* 
	* Message
	*
	*/
	/** @test */
    public function an_authenticated_user_can_see_messages_in_their_room()
    {
    	try{
	    	$user = $this->app->make('user');
	    	$user->name = 'test';
	    	$user->save();

	    	$room = new Room;
	    	$room->from_user_id = $user->id;
	    	$room->to_user_id = 1;
	    	$room->save();

	    	$message = new Message;
	    	$message->room_id = $room->id;
	    	$message->user_id = $user->id;
	    	$message->message = 'こんにちわ';
	    	$message->save();

	    	$response = $this->actingAs($user)
	    					 ->get('/messages/'.$room->id);

	    	$this->assertContains(json_encode('こんにちわ'),json_encode($response));

	    	$user->delete();
    	}catch(\Exception $e){
    		echo $e;
    		$user->delete();
    	}
    }

    /** @test */
    public function an_authenticated_user_can_post_a_message_in_their_room()
    {
    	try{
	    	$user = $this->app->make('user');
	    	$user->name = 'test';
	    	$user->save();

			$room = new Room;
	    	$room->from_user_id = $user->id;
	    	$room->to_user_id = 1;
	    	$room->save();

	    	$request = ['message' => 'ゴンザレス',
	    				'roomId' => $room->id,
	    				'user' => ['name' => $user->name,
	    						   'id' => $user->id,
	    						   'img_path' => '',],

	    				];

	    	$response = $this->actingAs($user)->post('/messages',$request);

	    	$this->assertContains(json_encode('ゴンザレス'),json_encode($response));

	    	$messages = $user->messages;
	    	foreach ($messages as $message) {
	    		$this->assertEquals($message->message,'ゴンザレス');
	    	}
	    	$user->delete();
    	}catch(\Exception $e){
    		echo $e;
    		$user->delete();
    	}

    }


    /** @test */
    public function an_authenticated_user_can_see_chat_lists()
    {
    	$user = User::where('id',1)->first();

    	$this->actingAs($user)
    		 ->get('/rooms/'.$user->id)
    		 ->assertSee('よりんすと')
    		 ->assertSee('Peeech公式')
    		 ->assertSee('遊べる貸切スペース');

    }


    /** @test */
    public function mark_on_the_latest_chats_in_the_chat_lists_page()
    {
    	
    }

}
