<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecommendedUserTest extends TestCase
{


    /** @test */
    public function guests_may_not_view_recommended_user()
    {
        $this->get('/friends/54');
    }

    /** @test */
    public function a_user_can_view_recommended_user_if_exist()
    {
    	// ユーザーを取得してログイン済みユーザーに設定
    	$user = $this->app->make('user')->where('id',54)->first();
    	$this->be($user);

    	// レコメンド前のユーザー(ファン友候補)を取得
        // レコメンド出来るユーザーがいる場合
        if($user->recommends()->where('settled',null)->exists()){
    	    $recommend = $user->recommends()->where('settled',null)->first();

            $friend = $this->app->make('user')->where('id',$recommend->friend_id)->first();
        	// 認証ユーザーが該当URLにアクセスするとファン友候補が表示される
        	$this->get('/friends/'.$user->id)
        	     ->assertSee($friend->name);

            $recommend->delete();
        }else{
            // レコメンド出来るユーザーがいない場合
            $this->get('/friends/'.$user->id)
                 ->assertSee('次のレコメンドをお待ち下さい');            
        }
    }

    /** @test */
    // public function a_user_can_not_view_recommended_user_if_already_judged_all()
    // {
    // 	// 既に全ファン友候補をジャッジすみユーザーを取得してログイン済みユーザーに設定
    // 	$user = $this->app->make('user')->where('id',54)->first();
    // 	$this->be($user);

    // 	$this->get('/friends/'.$user->id)
    // 	     ->assertSee('次のレコメンドをお待ち下さい');
    // }

    /** @test */
    public function a_user_can_not_view_recommended_user_if_not_match_favorite_idols()
    {
         //ユーザー作成(SNS認証後と同じ状態を作る)
        $user = $this->app->make('user');
        $user->name = 'より';
        $user->save();

        //リクエストデータ準備
        $request = makeUserRequest();

        try{
	        $id = $user->id;
	        $this->actingAs($user)
	             ->json('POST', '/profiles/'.$id, $request);

	        $this->be($user);

	    	$this->get('/friends/'.$user->id)
	    	     ->assertSee('該当するファン友候補はまだいません');

	    	$user->delete();
    	}catch(\Exception $e){
    		$user->delete();
    	}     

    }
    
	/** @test */
    public function a_user_can_not_view_page_if_different_id()
    {
    	$user = $this->app->make('user')->where('id',54)->first();
    	$this->be($user);

    	$this->get('/friends/57')
    	     ->assertSee('該当ユーザーは存在しません');

    }
}
