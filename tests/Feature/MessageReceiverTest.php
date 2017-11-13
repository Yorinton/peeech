<?php

namespace Tests\Feature;

use Faker\Factory;
use Peeech\Application\Services\Message\MessageReceiver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MessageReceiverTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
//    public function testNotify()
//    {
//
//        $user = $this->app->make('user')->where('id',83480)->first();
//        $this->be($user);
//
//        dd(MessageReceiver::hasNotReadMessage(2));
//        $this->assertTrue(true);
//    }

    public function testReceiveMessage()
    {
        /*
         * テストデータ準備
         * User x 2(送信者・受信者)/Room/Message(未読・未通知/未読・既通知)
         *
         * */

         //ファクトリに書き直す
         $sender = createTestUserData(1);
         $receiver = createTestUserData(2);

         $room = createTestRoomData($sender,$receiver);

         createTestMessageData($room,$sender);
         createTestMessageData($room,$sender);

         MessageReceiver::toHasReadMessage($room->id,$receiver->id);

         $this->assertDatabaseHas('messages',[
             'user_id' => $sender->id,
             'room_id' => $room->id,
             'has_read' => 1
         ]);


    }

}
