<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store($feed_id, CommentRequest $request)
    {
        $this->commentRepository->store($feed_id, $request);
        return $this->createResponse('Comment success');
    }

    public function getComments($feed_id)
    {
        $comments = $this->commentRepository->getComments($feed_id);
        return CommentResource::collection($comments);
    }

    public function update($comment_id, CommentRequest $request)
    {
        $comment = $this->commentRepository->update($comment_id, $request);
        return new CommentResource($comment);
    }

    public function delete($comment_id)
    {
        $this->commentRepository->delete($comment_id);
        return $this->createResponse('Delete success');
    }
}
