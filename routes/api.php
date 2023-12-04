<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Like\LikeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('feed')->controller(FeedController::class)->group(function () {
        Route::get('/', 'getFeeds');
        Route::post('store', 'store');
        Route::get('user/{user_id}', 'getFeedsByUserId');
        Route::get('{feed_id}', 'getFeed');
        Route::put('{feed_id}', 'update')->middleware('feed.owner');
        Route::delete('{feed_id}', 'delete')->middleware('feed.owner');
    });

    Route::prefix('comment')->controller(CommentController::class)->group(function () {
        Route::post('store/{feed_id}', 'store');
        Route::get('{feed_id}', 'getComments');
        Route::put('{comment_id}', 'update')->middleware('comment.owner');
        Route::delete('{comment_id}', 'delete')->middleware('comment.owner');
    });

    Route::prefix('like')->controller(LikeController::class)->group(function () {
        Route::get('show/{feed_id}', 'getLikes');
        Route::post('{feed_id}', 'likePost');
    });

    Route::get('/logout', [AuthenticationController::class, 'logout']);
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
