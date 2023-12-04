<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'content' => $this->content,
            'created_at' => date_format($this->created_at, "Y/m/d"),
            'liked' => $this->whenLoaded('likes', function () {
                return (bool) $this->likes()->where('feed_id', $this->id)->where('user_id', auth()->id())->exists();
            }),
            'likes_count' => $this->whenLoaded('likes', function () {
                return $this->likes()->count();
            }),
            'comments_count' => $this->whenLoaded('comments', function () {
                return $this->comments()->count();
            }),
        ];
    }
}
