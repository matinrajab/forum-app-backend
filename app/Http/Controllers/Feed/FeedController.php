<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\FeedResource;
use App\Repositories\FeedRepository;

class FeedController extends Controller
{
    private $feedRepository;

    public function __construct(FeedRepository $feedRepository)
    {
        $this->feedRepository = $feedRepository;
    }

    public function store(PostRequest $request)
    {
        $this->feedRepository->store($request);
        return $this->createResponse('Post success');
    }

    public function getFeeds()
    {
        $feeds = $this->feedRepository->getFeeds();
        return FeedResource::collection($this->loadCommentsAndLikes($feeds));
    }

    public function getFeedsByUserId($user_id)
    {
        $feeds = $this->feedRepository->getFeedsByUserId($user_id);
        return FeedResource::collection($this->loadCommentsAndLikes($feeds));
    }

    public function getFeed($feed_id)
    {
        $feed = $this->feedRepository->getFeed($feed_id);
        return new FeedResource($this->loadCommentsAndLikes($feed));
    }

    public function update($feed_id, PostRequest $request)
    {
        $feed = $this->feedRepository->update($feed_id, $request);
        return new FeedResource($this->loadCommentsAndLikes($feed));
    }

    public function delete($feed_id)
    {
        $this->feedRepository->delete($feed_id);
        return $this->createResponse('Delete success');
    }

    private function loadCommentsAndLikes($feed)
    {
        return $feed->loadMissing([
            'comments:id,feed_id',
            'likes:id,feed_id'
        ]);
    }
}
