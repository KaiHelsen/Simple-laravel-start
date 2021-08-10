<?php

namespace App\Http\Controllers;

use App\Jobs\StoreTweet;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    //
    public function index()
    {
        return Tweet::all();
    }

    public function find(int $id)
    {
        return Tweet::findOrFail($id);
    }

    public function createAndStore(Request $request)
    {
        $tweet = Tweet::make($request->all());
        StoreTweet::dispatch($tweet);
        return response()->json($tweet, 201);
    }

    public function reply(Request $request, int $id)
    {
        $tweet = Tweet::make($request->all());
        $tweet->setAttribute('tweed_id', $id);
        StoreTweet::dispatchSync($tweet);
        return Response()->json($tweet, 201);
    }

    public function delete(Request $request, int $id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();

        return response()->json(null, 204);
    }
}
