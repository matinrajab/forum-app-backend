<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Feed;

class CommentController extends Controller
{
    public function store($feed_id, CommentRequest $request)
    {
        $request->validated();

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

        $comments = Comment::whereFeedId($feed_id)->with('user')->get();

        return response([
            'comments' => $comments
        ], 200);
    }
}
