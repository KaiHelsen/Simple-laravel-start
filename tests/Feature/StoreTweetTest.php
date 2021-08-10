<?php

namespace Tests\Feature;

use App\Jobs\StoreTweet;
use App\Models\Tweet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTweetTest extends TestCase
{
    use RefreshDatabase;

    public function test_tweet_store()
    {
        $this->seed();
        $tweet = Tweet::make([
            'user_id' => 1,
            'tweed_id' => 3,
            'contents' => "bar!!!!",
        ]);
        $job = new StoreTweet($tweet);
        $job->handle();

        $this->assertDatabaseCount('tweets', 7);
        $this->assertDatabaseHas('tweets', ['contents' => 'bar!!!!', 'tweed_id' => 3]);
    }
}
