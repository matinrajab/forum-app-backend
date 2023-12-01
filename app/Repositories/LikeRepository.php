<?php

namespace App\Repositories;

use App\Http\Resources\LikeResource;
use App\Models\Feed;
use App\Models\Like;

class LikeRepository
{
    public function likePost($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();
        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }
        $unlike = Like::where('user_id', auth()->id())->where('feed_id', $feed_id)->delete();
        if ($unlike) {
            return response([
                'message' => 'Unliked'
            ], 200);
        }
        Like::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed_id
        ]);
        return response([
            'message' => 'Liked'
        ], 200);
    }

    public function getLikes($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();
        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }
        $likes = Like::whereFeedId($feed_id)->get();
        return LikeResource::collection($likes);
    }
}
