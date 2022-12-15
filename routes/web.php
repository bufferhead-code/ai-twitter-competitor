<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function (User $user) {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/users/followings-tweets', [\App\Http\Controllers\UserController::class, 'followingsTweets'])->name('users.followings-tweets');
Route::post('/tweets', [\App\Http\Controllers\TweetController::class, 'store'])->name('tweets.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $tweets = $user->followings()
            ->with('tweets.user') // eager load the user for each tweet
            ->get()
            ->pluck('tweets')
            ->flatten()
            ->sortByDesc('created_at')
            ->values();

        return Inertia::render('Dashboard', [
            'tweets' => $tweets
        ]);
    })->name('dashboard');
});

Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
Route::get('/users', [UserController::class, 'index'])->name('users');
