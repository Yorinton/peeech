<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\SocialAccountService as SocialAccountService;
use Auth;

class SocialAccountController extends Controller
{

    protected $is_production;

    public function __construct()
    {
        $this->is_production = env('APP_ENV') === 'production' ? true : false;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     * プロバイダの認証ページへのリダイレクト
     * @return Response
     */

    public function redirectToProvider($provider)
    {
    	return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     * プロバイダからのコールバック受け取り
     * @return Response
     */

    public function handleProviderCallback(SocialAccountService $accountService,$provider)
    {
    	try{
    		//Laravel\Socialite\Contracts\Userのインスタンス = SNSアカウントのUserインスタンス
    		$user = \Socialite::with($provider)->user();

    	}catch(\Excepion $e){
    		// /loginルートにリダイレクト
    		// echo $e;
    		return redirect('/login');
    	}

        try{
        	//SocialAccountServiceは別途作成する必要がある / Userインスタンスが返される
            $result = $accountService->findOrCreate($user,$provider);
        	$authUser = $result[1];
            $status = $result[0];
        	
        	//すでに存在しているuserインスタンスでログインさせる場合はloginメソッドを使う
        	//authヘルパ関数はAuthファザードの代わりに使える
        	auth()->login($authUser,true);
        	//Auth::login($authUser,true);と同じ

            if($status == 'register'){
                if(Auth::check()){
                    return redirect('/registerpage/'.$authUser->id,302,[],$this->is_production);
                }else{
                    return view('auth.login');
                }
            	//認証後プロフィールページにリダイレクト
//            	return redirect()->to('/home/'.$authUser->id);

            }elseif($status == 'login'){

//                return redirect()->route('profiles',[$authUser]);
                return redirect('/profiles/'.$authUser->id,302,[],$this->is_production);
            }

        }catch(\Exception $e){
            echo "アカウント作成に失敗しました。再度お試し下さい";
            echo $e->getMessage();
        }
    }

}
