<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Feed;
use App\Models\User;

class FeedController extends Controller
{
    public function store(PostRequest $request)
    {
        $request->validated();

        Feed::create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return response([
            'message' => 'Success'
        ], 201);
    }

    public function getFeeds()
    {
        $feeds = Feed::with('user')->latest()->get();
        return response([
            'feeds' => $feeds
        ], 200);
    }

    public function getFeedsByUserId($user_id)
    {
        $user = User::whereId($user_id)->first();
        if (!$user) {
            return response([
                'message' => 'User not found'
            ], 404);
        }

        $feeds = Feed::whereUserId($user_id)->with('user')->latest()->get();
        return response([
            'feeds' => $feeds
        ], 200);
    }

    public function getFeed($feed_id)
    {
        $feed = Feed::whereId($feed_id)->with('user')->first();

        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }

        return response([
            'feed' => $feed
        ], 200);
    }
}
