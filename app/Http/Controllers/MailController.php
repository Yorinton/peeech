<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\User;
use App\Mail\MatchingNotification;
use Illuminate\Support\Facades\Mail;
use Auth;

class MailController extends Controller
{
    //
    public function sendMail()
    {
    	$friends_num = 3;
    	$friend_ex = User::where('id',3)->first();
    	$user = Auth::user();
        Mail::to('ka2ki.yori@outlook.com')->send(new MatchingNotification($friends_num,$friend_ex,$user));

        return redirect()->to('/rooms/'.$user->id);
    }
}
