<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\SocialAccountService as SocialAccountService;

class SocialAccountController extends Controller
{

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
            	//認証後プロフィールページにリダイレクト
            	return redirect()->to('/home/'.$authUser->id);

            }

        }catch(\Exception $e){
            echo "アカウント作成に失敗しました。再度お試し下さい";
            echo $e;
        }
    }

}
