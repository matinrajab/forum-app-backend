<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Feed;
use App\Models\Like;
use App\Repositories\LikeRepository;

class LikeController extends Controller
{
    private $likeRepository;

    public function __construct()
    {
        $this->likeRepository = new LikeRepository();
    }

    public function likePost($feed_id)
    {
        return $this->likeRepository->likePost($feed_id);
    }

    public function getLikes($feed_id)
    {
        return $this->likeRepository->getLikes($feed_id);
    }
}
