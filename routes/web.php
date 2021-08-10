<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

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
Route::Get('/', function ()
{
    return 'hello';
});

Route::get('/info', function ()
{
    echo phpinfo();
});

//TODO: some testing routes, scrap these later
Route::get('/nottwitter', [TweetController::class, 'index']);

Route::middleware(['ValidateTweetLength',])->group(function ()
{
    Route::resource('tweets', TweetController::class);
});



