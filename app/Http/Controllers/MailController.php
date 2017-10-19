<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\User;
use App\Mail\MatchingNotification;
use Illuminate\Support\Facades\Mail;
use Auth;
use Artisan;

class MailController extends Controller
{
    //
    public function sendMail()
    {

        $exitCode = Artisan::call('matching:email');
        return $exitCode;

//    	$friends_num = 3;
//    	$friend_ex = User::where('id',32)->first();
//    	$user = Auth::user();
//        Mail::to(decrypt($user->email))->send(new MatchingNotification($friends_num,$friend_ex,$user));
//
//        return redirect()->to('/rooms/'.$user->id);
    }
}
