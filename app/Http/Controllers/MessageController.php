<?php

namespace App\Http\Controllers;

use App\Eloquent\Message as Message;
use App\Eloquent\Room as Room;
use Illuminate\Http\Request;
use Auth;
use App\Events\MessagePosted;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($room_id)
    {
        return Message::with('user')->where('room_id',$room_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $message = new Message();
        $message->message = request('message');
        $message->room_id = request('roomId');//おいおい編集
        $message->has_read = false;
        $message->notified = false;

        $user->messages()->save($message);

        //roomsのupdated_atを更新する
        $room = Room::where('id',$message->room_id)->first();
        Room::where('id',$message->room_id)->update(['from_user_id' => $room->from_user_id]);

        //Announce that a new message has been posted
        broadcast(new MessagePosted($message,$user))->toOthers();

        return ["message" => request('message')];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppEloquentMessage  $appEloquentMessage
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppEloquentMessage  $appEloquentMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppEloquentMessage  $appEloquentMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppEloquentMessage  $appEloquentMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
