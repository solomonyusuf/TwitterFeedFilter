<?php

namespace App\Console\Commands;

use App\Jobs\TwitterFeedJob;
use Illuminate\Console\Command;

class SaveTwitterPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:save';
    protected $description = 'Fetch and save Twitter posts.';

    public function handle()
    {
        TwitterFeedJob::dispatch();
        $this->info('Twitter posts saved.');
    }
}
