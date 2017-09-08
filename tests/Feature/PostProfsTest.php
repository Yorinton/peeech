<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use App\Eloquent\User as User;
use App\Eloquent\Idol as Idol;
use App\Eloquent\Purpose as Purpose;
use App\Eloquent\Region as Region;

use App;

class PostProfsTest extends TestCase
{

    use App\Libs\DisplayData;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function createNewUserProfsTest()
    {
        //ユーザー作成(SNS認証後と同じ状態を作る)
        $user = $this->app->make('user');
        $user->name = 'より';
        $user->save();

        //リクエストデータ準備
        $request = makeUserRequest();

        try{
            //POSTでプロフィールデータを保存
            $id = $user->id;
            $this->actingAs($user)
                 ->json('POST', '/profiles/'.$id, $request);

            //登録emailが表示されることを確認
            $this->actingAs($user)
                 ->json('GET','/profiles/'.$id)
                 ->assertSee($request['year'])
                 ->assertSee($request['month'])
                 ->assertSee($request['day'])
                 ->assertSee($request['added_idol'])
                 ->assertSee($request['region']);
            $this->assertEquals('1920-10-11',$user->birthday);
            //最後にテスト用ユーザーを削除
            $user->delete();
        }catch(\Exception $e){
            $user->delete();
        }
    }
    /** @test */
    public function testUpdateUserTest()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $request = ['name' => 'ピーター'];
        // $key = 'name';
        // $word = 'Meron';
        $response = $this->actingAs($user)
                         ->json('PATCH', '/users/1', $request);

        $this->get('/profiles/1')->assertSee($request['name']);
    }
    /** @test */
    public function a_authenticated_user_can_add_item_of_profs()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $this->be($user);
        $key = 'idol';
        $word = 'HKT48';
        $response = $this->json('POST', '/users/1', [$key => $word]);
        $idols = Idol::where('user_id',1)->get();
        $idols_fix = $this->objArrToPropArr($idols,'idol');
        $this->assertContains($word,$idols_fix);
        Idol::where('idol','HKT48')->delete();
    }

    /** @test */
    public function a_authenticated_user_can_edit_text_of_profs()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $this->be($user);
        $key = 'region';
        $word = '東京都';
        $response = $this->post('users/1',[$key => $word]);

        $region = Region::where('user_id',$user->id)->first();
        $this->assertEquals($word,$region->region);

        //編集した値を元に戻す
        $region->region = '福岡県';
        $region->save();
    }
    /** @test */
    public function a_authenticated_user_can_show_own_profs()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $this->be($user);

        $response = $this->get('/profiles/'.$user->id)
                         ->assertSee('福岡県'); 
    }


    /** @test */
    public function testUpdateOtherProfsMultipleTest()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $this->be($user);
        $key = 'purpose';
        $wordArr = [1,4];
        $response = $this->json('POST', '/users/1', [$key => $wordArr]);
        $purposes = Purpose::where('user_id',1)->get();
        $purpose_ids = $this->objArrToPropArr($purposes,'purpose_id');
        
        $this->assertTrue($this->identical_values($purpose_ids,$wordArr));
    }

    /** @test */
    public function a_user_can_add_activity()
    {
        $user = $this->app->make('user')->where('id',1)->first();

        $request = [
            'user_id' => 1,
            'activity' => '握手会'
        ];

        $this->actingAs($user)
             ->post('/users/1',$request);
        $activity = $user->activities()->first();
        $this->assertEquals($request['activity'],$activity->activity);
        $activity->delete();

    }
    /** @test */
    public function a_user_get_own_activity()
    {
        $user = $this->app->make('user')->where('id',1)->first();
    }



}
