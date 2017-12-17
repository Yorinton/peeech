<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $is_production;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->is_production = env('APP_ENV') === 'production' ? true : false;
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
        return redirect('/profiles/'.$user->id,302,[],$this->is_production);
//        return redirect()->route('profiles',[$user]);
    }


}
