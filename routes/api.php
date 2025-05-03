<?php

use App\Jobs\SaveTwitterFeedJob;
use App\Jobs\TwitterFeedJob;
use App\Models\TwitterFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/get-feed', function () {

    $response = Http::withToken(env('TWITTER_BEARER_TOKEN'))
    ->get('https://api.twitter.com/2/tweets/search/recent', [
        'query' => 'crypto news (from:Cointelegraph OR from:Decryptmedia OR from:CryptoSlate OR from:TheBlock__ OR from:CryptoNewsZ OR from:BTC_Archive OR from:BitcoinMagazine OR from:WatcherGuru OR from:CryptoBusy OR from:AltcoinDailyio OR from:Investingcom)',
        'max_results' => 100,
        'tweet.fields' => 'created_at,author_id,text',
    ]);

    $result = $response->json();
    
    return response()->json([
        'data' => $result
    ], 200);
});
