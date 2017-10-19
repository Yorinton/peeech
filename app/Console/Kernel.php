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
        Commands\Recommend::class,
        Commands\MatchingNotification::class
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
//        $schedule->command('matching:email')->withoutOverlapping();

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
