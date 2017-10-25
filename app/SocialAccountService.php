<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Eloquent\LinkedSocialAccount;
use App\Eloquent\User;

class SocialAccountService
{

	/**
	 *
	 * ローカルのUserと関連するSNSアカウントを作成・取得する
	 *
	**/
	public function findOrCreate(ProviderUser $providerUser,$provider)
	{
        //SNSアカウントを取得
        $account = LinkedSocialAccount::where('provider_name',$provider)
            ->where('provider_id',$providerUser->getId())
            ->first();

        //SNSアカウントが存在する場合、関連するUserインスタンスを取得(アカウント作成済み = ログイン)
        if($account){
            $user = $account->user;

            // ステータスとユーザーを返す
            $result = array('login',$user);
            return $result;
        }else {

            //SNSアカウントのemailに紐づくUserインスタンスを取得
            $user = User::where('email', $providerUser->getEmail())->first();

            //SNSアカウントのemailにひもづくUserインスタンスが無い場合
            if (!$user) {
                //SNSアカウントのemailとnameを使ってUserインスタンスを作成しテーブルに保存
                $email = encrypt($providerUser->getEmail());
                $user = new User();
                $user->email = $email;
                $user->name = $providerUser->getName();
                $user->img_path = $providerUser->getAvatar();
                $user->save();
            }

            //Userに関連するLinkedSocialAccountインスタンスを作成
            $user->accounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            $result = array('register', $user);
            return $result;
        }

    }
}



?>