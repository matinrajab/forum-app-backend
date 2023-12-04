<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $comment = Comment::whereId($request->comment_id)->first();

        if (!$comment || ($comment->user_id != $currentUser->id)) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return $next($request);
    }
}
