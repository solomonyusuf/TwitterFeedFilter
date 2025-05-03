<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TwitterFeed
 * 
 * @property string $id
 * @property string $tweet_id
 * @property string $text
 * @property string $author_id
 * @property Carbon $tweeted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TwitterFeed extends Model
{
	use HasUuids;
	protected $table = 'twitter_feeds';
	public $incrementing = false;

	protected $casts = [
		'tweeted_at' => 'datetime'
	];

	protected $fillable = [
		'id',
		'text',
		'tweet_id',
		'author_id',
		'tweeted_at'
	];
}
