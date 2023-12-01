<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Like\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/feed/store', [FeedController::class, 'store']);
    Route::get('/feeds', [FeedController::class, 'getFeeds']);
    Route::get('/feeds/user/{user_id}', [FeedController::class, 'getFeedsByUserId']);
    Route::get('/feed/{feed_id}', [FeedController::class, 'getFeed']);
    Route::post('/feed/like/{feed_id}', [LikeController::class, 'likePost']);
    Route::get('/feed/likes/{feed_id}', [LikeController::class, 'getLikes']);
    Route::post('/feed/comment/store/{feed_id}', [CommentController::class, 'store']);
    Route::get('/feed/comments/{feed_id}', [CommentController::class, 'getComments']);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
