<?php

namespace App\Repositories;

use App\Models\Feed;
use App\Models\User;

const COMMENT_ATRIBUTE = 'comments:id,feed_id';
const LIKE_ATRIBUTE = 'likes:id,feed_id';

class FeedRepository
{
    public function store($request)
    {
        Feed::create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
    }

    public function getFeeds()
    {
        return Feed::latest()->get();
    }

    public function getFeedsByUserId($user_id)
    {
        User::whereId($user_id)->firstOrFail();
        return Feed::whereUserId($user_id)->latest()->get();
    }

    public function getFeed($feed_id)
    {
        return Feed::whereId($feed_id)->firstOrFail();
    }

    public function update($feed_id, $request)
    {
        $feed = Feed::whereId($feed_id)->first();
        $feed->update($request->all());
        return $feed;
    }

    public function delete($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();
        $feed->comments()->delete();
        $feed->likes()->delete();
        $feed->delete();
    }
}
