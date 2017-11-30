<?php

namespace App;

use App\Eloquent\Recommend as Recommend;
use App\Eloquent\User as User;
use App\Mail\RecommendNotification;
use App\Repositories\Recommend\RecommendRepository;
use App\Repositories\User\UserRepository;
use DB;
use Mail;


class RecommendService
{

    use Libs\DisplayData;

    protected $Rrepo;
    protected $Urepo;

    public function __construct(RecommendRepository $Rrepo, UserRepository $Urepo)
    {
        $this->Rrepo = $Rrepo;
        $this->Urepo = $Urepo;
    }

    // Userに関連するモデルのコレクションからUserのリストを生成する(Matchingsでも使えるかも)
    public function collectionsToUserLists($collections, $keyInUser)
    {
        $friends = [];
        foreach ($collections as $collection) {
            $friend = $this->Urepo->getUserById($collection->$keyInUser);
            $friend->birthday = $this->birthdayFormat($friend->birthday);
            $friend->sex = $this->sexFormat($friend->sex);
            $friends[] = $friend;
        }
        return $friends;
    }

    public function getRecommendListsById($id)
    {
        $recommends = $this->Rrepo->getRecommendOnlySettledNullById($id);
        // recommendsのfriend_idをキーにUserのリストを生成する
        return $this->collectionsToUserLists($recommends, 'friend_id');
    }

    public function recommendFriendsToUser()
    {
        if (User::all()) {

            // 全Userを取得
            $users = User::all();

            // 全てのUserに対して実施
            foreach ($users as $user) {

                //オブジェクトの配列が返ってくる
                $friends = DB::select(DB::raw("select id from users where id = any(select distinct user_id from idols where idol = any(select idol from idols where user_id = $user->id)) and id != $user->id and id not in (select friend_id from recommends where user_id = $user->id) limit 3"));

                //同じアイドルが好きなファン友候補のfriend_idをrecommendsテーブルに保存
                foreach ($friends as $friend) {
                    $recommend = new Recommend();
                    $recommend->friend_id = $friend->id;
                    $recommend->user_id = $user->id;
                    $recommend->save();
                }
                if (count($friends) > 0) {
                    Mail::to(decrypt($user->email))->send(new RecommendNotification($user));
                }

            }

        }
    }

    public static function isRecommend(int $user_id): bool
    {
        $recommend = resolve('Peeech\Domain\Models\Recommend\Recommend');
        return $recommend->isRecommend($user_id);
    }

    public static function recommendImagePath(int $user_id)
    {
        return self::isRecommend($user_id) ? 'images/services/recommend_finish.png' : 'images/services/recommend_before.png';
    }
}
