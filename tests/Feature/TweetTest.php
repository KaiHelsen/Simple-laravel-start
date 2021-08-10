<?php

namespace Tests\Feature;

use App\Jobs\StoreTweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tweet_factories()
    {
        $this->seed();
        $this->assertDatabaseCount('tweets', 6);
    }

    public function test_index_successfull()
    {
        $this->seed();
        $response = $this->call('GET', '/api/tweet');
        $response->assertStatus(200);
        $this->assertJson($response->content());
    }

    public function test_find_tweet_successfull()
    {
        $this->seed();
        $response = $this->call('GET', '/api/tweet/' . 1);
        $response->assertStatus(200);
        $this->assertJson($response->content());
    }
    public function test_tweet_made_successfully()
    {
        \Bus::fake();
        $this->seed();
        $user = User::factory()->create();

        $payload = [
            'user_id' => 1,
            'tweed_id' => null,
            'contents' => 'foo!',
        ];

        $response = $this
            ->actingAs($user)
            ->post('/api/tweet/make', $payload);

        $response->assertStatus(201);
        \Bus::assertDispatched(StoreTweet::class);
    }

    public function test_tweet_made_no_authentication()
    {
        \bus::fake();
        $this->seed();

        $payload = [
            'user_id' => 1,
            'tweed_id' => null,
            'contents' => 'foo!',
        ];

        $response = $this
            ->post('/api/tweet/make', $payload);

        $response->assertStatus(500);
        \bus::assertNotDispatched(StoreTweet::class);

    }

    public function test_tweet_reply_successfully()
    {
        \bus::fake();
        $this->seed();
        $user = User::factorY()->create();

        $payload = [
            'user_id' => 1,
            'tweed_id' => 3,
            'contents' => "bar!!!!",
        ];

        $response = $this
            ->actingAs($user)
            ->post('/api/tweet/reply/3', $payload);

        \Bus::assertDispatched(StoreTweet::class);
        $response->assertStatus(201);
    }

    public function test_tweet_deleted_successfully()
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/api/tweet/delete/' . 1);

        $this->assertEquals(204, $response->status());
        $this->assertDatabaseCount('tweets', 5);
    }
}
