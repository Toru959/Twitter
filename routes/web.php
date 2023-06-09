<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth'])->name('dashboard');

Route::get('/timeline', [TweetController::class, 'showTimelinePage'])->name('timeline');
Route::post('/timeline', [TweetController::class, 'postTweet']);
Route::post('/timeline/delete/{id}', [TweetController::class, 'destroy'])->name('destroy');

Route::get('/user/show/{id}', [UserController::class, 'show'])->name('show');

Route::get('tweets/{tweet_id}/likes', [LikeController::class, 'store']);
Route::get('likes/{like_id}', [LikeController::class, 'destroy']);

require __DIR__.'/auth.php';
