<?php

namespace App\Console;

use DB;
use App\Eloquent\User as User;
use App\Eloquent\Recommend as Recommend;
use App\Eloquent\Matching as Matching;
use App\Mail\MatchingNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // 同じアイドル好きのユーザーをrecommendsテーブルに登録
        $schedule->call(function () {
            if(User::all()){

                // 全Userを取得
                $users = User::all();
                
                // 全てのUserに対して実施
                foreach ($users as $user) {

                    //オブジェクトの配列が返ってくる
                    $friends = DB::select(DB::raw("select id from users where id = any(select user_id from idols where idol = any(select idol from idols where user_id = $user->id)) and id != $user->id and id not in (select friend_id from recommends where user_id = $user->id)"));
                    //同じアイドルが好きなファン友候補のfriend_idをrecommendsテーブルに保存
                    foreach ($friends as $friend) {
                        $recommends = new Recommend();
                        $recommends->friend_id = $friend->id;
                        $user->recommends()->save($recommends);
                    }
                }
            }
        })->everyMinute();


        // 新しくマッチングした場合にお知らせ
        // すでにお知らせ済みの人を除く処理実装の必要あり
        $schedule->call(function(){
        	if(User::all()){
        		// 全Userを取得
                $users = User::all();
                foreach ($users as $user) {
                	$matchings = Matching::where('from_user_id',$user->id)->where('judge',1)->get();
                	$friends = [];
                	foreach ($matchings as $matching) {
                		if(Matching::where('from_user_id',$matching->to_user_id)->where('to_user_id',$user->id)->where('judge',1)->exists()){
                            if($matching->settled === null){
                                $friend = User::where('id',$matching->to_user_id)->first();
                                $friends[] = $friend;
                                $matching->settled = true;
                                $matching->save();
                            }
                		}
                	}
                    // 配列を操作する際はその配列の要素が１つ以上存在するかチェックしてから
                    if(count($friends) > 0){
                    	$friends_num = count($friends);
                    	$friend_ex = $friends[0];

                        // MatchingNotificationインスタンスの引数にファン友数とファン友の一人のインスタンスと自分のインスタンスを渡す
                    	Mail::to(decrypt($user->email))->send(new MatchingNotification($friends_num,$friend_ex,$user));
                    }
                }
        	}	
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
