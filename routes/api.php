<?php

use App\Http\Controllers\TweetController;
use App\Http\Middleware\AuthenticateTweetUser;
use App\Http\Middleware\ValidateTweetLength;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::get('tweet', [TweetController::class, 'index']);
Route::get('tweet/{id}', [TweetController::class, 'find']);
Route::middleware(['auth'])
    ->group(function ()
    {
        Route::post('tweet/make', [TweetController::class, 'createAndStore']);
        Route::post('tweet/reply/{id}', [TweetController::class, 'reply']);
        Route::delete('tweet/delete/{id}', [TweetController::class, 'delete']);
    });
