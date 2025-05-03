<?php

namespace App\Jobs;

use App\Models\TwitterFeed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
class TwitterFeedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
           $response = Http::withToken(env('TWITTER_BEARER_TOKEN'))
                ->get('https://api.twitter.com/2/tweets/search/recent', [
                    'query' => 'crypto news (from:Cointelegraph OR from:Decryptmedia OR from:CryptoSlate OR from:TheBlock__ OR from:CryptoNewsZ OR from:BTC_Archive OR from:BitcoinMagazine OR from:WatcherGuru OR from:CryptoBusy OR from:AltcoinDailyio OR from:Investingcom)',
                    'max_results' => 100,
                    'tweet.fields' => 'created_at,author_id,text',
                ]);
            
            $result = $response->json();
            $tweets = $result['data'] ?? [];

            foreach ($tweets as $tweet) {
                // Avoid duplicates using tweet_id
                TwitterFeed::updateOrCreate(
                    ['tweet_id' => $tweet['id']
                ],
                    [
                        'text' => $tweet['text'],
                        'tweet_id' => $tweet['id'],
                        'author_id' => $tweet['author_id'],
                        'tweeted_at' => $tweet['created_at'],
                    ]
                );
            }

            sleep(10000);
    }
}
