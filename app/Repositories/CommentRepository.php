<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Feed;

class CommentRepository
{
    public function store($feed_id, $request)
    {
        Feed::whereId($feed_id)->firstOrFail();
        Comment::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed_id,
            'content' => $request->content
        ]);
    }

    public function getComments($feed_id)
    {
        Feed::whereId($feed_id)->firstOrFail();
        return Comment::whereFeedId($feed_id)->get();
    }

    public function update($comment_id, $request)
    {
        $comment = Comment::whereId($comment_id)->first();
        $comment->update($request->all());
        return $comment;
    }

    public function delete($comment_id)
    {
        $comment = Comment::whereId($comment_id)->first();
        $comment->delete();
    }
}
