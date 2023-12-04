<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Repositories\LikeRepository;

class LikeController extends Controller
{
    private $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function likePost($feed_id)
    {
        $liked = $this->likeRepository->likePost($feed_id);
        return $liked ? $this->createResponse('liked') : $this->createResponse('unliked');
    }

    public function getLikes($feed_id)
    {
        $likes = $this->likeRepository->getLikes($feed_id);
        return LikeResource::collection($likes);
    }
}
