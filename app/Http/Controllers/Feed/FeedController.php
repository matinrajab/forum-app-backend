<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\FeedRepository;

class FeedController extends Controller
{
    private $feedRepository;

    public function __construct()
    {
        $this->feedRepository = new FeedRepository();
    }

    public function store(PostRequest $request)
    {
        return $this->feedRepository->store($request);
    }

    public function getFeeds()
    {
        return $this->feedRepository->getFeeds();
    }

    public function getFeedsByUserId($user_id)
    {
        return $this->feedRepository->getFeedsByUserId($user_id);
    }

    public function getFeed($feed_id)
    {
        return $this->feedRepository->getFeed($feed_id);
    }
}
