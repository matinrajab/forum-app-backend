<?php

namespace App\Repositories;

use App\Models\Feed;
use App\Models\Like;

class LikeRepository
{
    public function likePost($feed_id)
    {
        Feed::whereId($feed_id)->firstOrFail();
        $feedLiked = $this->isLiked($feed_id);
        return $feedLiked ? $this->unlike($feedLiked) : $this->like($feed_id);
    }

    public function isLiked($feed_id)
    {
        return Like::whereUserId(auth()->id())->whereFeedId($feed_id)->first();
    }

    public function like($feed_id)
    {
        Like::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed_id
        ]);
        return true;
    }

    public function unlike($feed)
    {
        $feed->delete();
        return false;
    }

    public function getLikes($feed_id)
    {
        Feed::whereId($feed_id)->firstOrFail();
        return Like::whereFeedId($feed_id)->get();
    }
}
