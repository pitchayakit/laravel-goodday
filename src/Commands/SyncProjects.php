<?php

namespace Lexicon\Goodday\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;

class SyncProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'goodday:sync-projects';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $goodday_token = config('goodday.api_token');

        $client = new Client();
        $request = new Request('GET', "https://api.goodday.work/2.0/projects?gd-api-token=$goodday_token");
        $res = $client->sendAsync($request)->wait();
        
        $res->getBody();
    }
}
