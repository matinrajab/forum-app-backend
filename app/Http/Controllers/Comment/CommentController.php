<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Feed;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function store($feed_id, CommentRequest $request)
    {
        return $this->commentRepository->store($feed_id, $request);
    }

    public function getComments($feed_id)
    {
        return $this->commentRepository->getComments($feed_id);
    }
}
