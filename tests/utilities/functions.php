<?php

use App\Eloquent\Message;
use App\Eloquent\Room;
use App\Eloquent\User;
use Faker\Factory;

function makeUserRequest()
{
	return [
            'name' => 'Yori',
            'email' => 'zeanagg@gmail.com',
            'sex' => 'male',
            // 'introduction' => '宜しくです！',
            'year' => 1922,
            'month' => 12,
            'day' => 10,
            'added_idol' => [1,2],
            // 'added_favorite' => ['推し１'],
            'purpose' => [1,2],
            // 'statue' => [2],
            // 'added_event' => ['握手会'],
            'region' => ['東京都'],
        ];
}

function createTestUserData(int $i)
{
    $faker = Factory::create();

    $user = new User();
    $user->name = 'テストユーザー'.$i;
    $user->email = encrypt($i.'aaaa@gmail.com');
    $user->sex = 'male';
    $user->birthday = $faker->date('Y-m-d', 'now');
    $user->img_path = '../../images/img01.jpg';
    $user->introduction = $faker->sentence(10);
    $user->password = $faker->sha256;
    $user->save();

    return $user;
}

function createTestRoomData(User $from_user,User $to_user)
{
    $room = new Room();
    $room->from_user_id = $from_user->id;
    $room->to_user_id = $to_user->id;
    $room->save();

    return $room;
}

function createTestMessageData(Room $room,User $sender)
{
    $faker = Factory::create();

    $message = new Message();
    $message->message = $faker->sentence();
    $message->user_id = $sender->id;
    $message->has_read = 0;
    $message->notified = 0;
    $room->messages()->save($message);

    return $message;

}