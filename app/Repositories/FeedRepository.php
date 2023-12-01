<?php

namespace App\Repositories;

use App\Http\Resources\FeedResource;
use App\Models\Feed;
use App\Models\User;

class FeedRepository
{
    public function store($request)
    {
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
        $feeds = Feed::latest()->get();
        return FeedResource::collection($feeds->loadMissing(['comments:id,feed_id', 'likes:id,feed_id']));
    }

    public function getFeedsByUserId($user_id)
    {
        $user = User::whereId($user_id)->first();
        if (!$user) {
            return response([
                'message' => 'User not found'
            ], 404);
        }
        $feeds = Feed::whereUserId($user_id)->latest()->get();
        return FeedResource::collection($feeds->loadMissing(['comments:id,feed_id', 'likes:id,feed_id']));
    }

    public function getFeed($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();
        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }
        return new FeedResource($feed->loadMissing(['comments:id,feed_id', 'likes:id,feed_id']));
    }
}
