<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::check()){
            //認証後プロフィールページにリダイレクト
            return redirect()->route('registerpage',['id' => $id]);
        }else{
            return view('auth.login');
        }
    }

    public function subindex()
    {
        $user = Auth::user();
        return redirect()->route('profiles',[$user]);
    }


}
