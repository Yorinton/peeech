<?php

namespace Tests\Feature;

use Faker\Factory;
use Peeech\Application\Services\Message\MessageReceiver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;

class MessageReceiverTest extends TestCase
{

//    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function testReceiveMessage()
    {
        /*
         * テストデータ準備
         * User x 2(送信者・受信者)/Room/Message(未読・未通知/未読・既通知)
         *
         * */

        //ファクトリに書き直す
        DB::beginTransaction();
        try {
            $sender = createTestUserData(1);
            $receiver = createTestUserData(2);

            $room = createTestRoomData($sender, $receiver);

            createTestMessageData($room, $sender);
            createTestMessageData($room, $sender);

            MessageReceiver::toHasReadMessage($room->id, $receiver->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        $this->assertDatabaseHas('messages', [
            'user_id' => $sender->id,
            'room_id' => $room->id,
            'has_read' => 1
        ]);

        $sender->delete();
        $receiver->delete();

    }

    public function testNotifyMessageReceived()
    {
        DB::beginTransaction();
        try {
            $sender = createTestUserData(1);
            $receiver = createTestUserData(2);

            $room = createTestRoomData($sender, $receiver);

            createTestMessageData($room, $sender);
            createTestMessageData($room, $sender);

            MessageReceiver::sendMessageNotification($room->id, $sender->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        $this->assertDatabaseHas('messages', [
            'user_id' => $sender->id,
            'room_id' => $room->id,
            'notified' => 1
        ]);

        $sender->delete();
        $receiver->delete();
    }

}
