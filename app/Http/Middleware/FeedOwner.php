<?php

namespace App\Http\Middleware;

use App\Models\Feed;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FeedOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $feed = Feed::whereId($request->feed_id)->first();

        if (!$feed || ($feed->user_id != $currentUser->id)) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return $next($request);
    }
}
