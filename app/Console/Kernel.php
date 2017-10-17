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
        Commands\Recommend::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // レコメンド
        // $schedule->command('recommend')->everyMinute();



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
        })->daily();
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
