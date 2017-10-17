<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RecommendService;

class Recommend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recommend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'recommend friends to user';


    protected $recommend;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RecommendService $recommend)
    {
        parent::__construct();
        $this->recommend = $recommend;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->recommend->recommendFriendsToUser();
    }
}
