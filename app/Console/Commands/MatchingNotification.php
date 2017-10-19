<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MatchingService;

class MatchingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matching:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email when users matched';


    protected $matchingService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MatchingService $matchingService)
    {
        parent::__construct();
        $this->matchingService = $matchingService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->matchingService->notifyMatching();
    }
}
