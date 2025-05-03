<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('twitter_feeds', function (Blueprint $table) {
            $table->uuid('id')->primary();  
            $table->string('tweet_id')->unique();  
            $table->longText('text');
            $table->string('author_id');
            $table->timestamp('tweeted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twitter_feeds');
    }
};
