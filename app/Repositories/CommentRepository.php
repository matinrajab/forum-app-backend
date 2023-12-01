<?php

namespace App\Repositories;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Feed;

class CommentRepository
{

    public function store($feed_id, $request)
    {
        $feed = Feed::whereId($feed_id)->first();
        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }
        Comment::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed_id,
            'content' => $request->content
        ]);
        return response([
            'message' => 'Comment success'
        ], 201);
    }

    public function getComments($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();
        if (!$feed) {
            return response([
                'message' => 'Feed not found'
            ], 404);
        }
        $comments = Comment::whereFeedId($feed_id)->get();
        return CommentResource::collection($comments);
    }
}
