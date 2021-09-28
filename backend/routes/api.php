<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'auth',
        
    ]
, function ($route) {
    Route::post('login', 'AuthController@login');
    Route::group(
        [
            'middleware' => 'auth:admin,user',
        ]
    , function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        Route::post('reset_password', 'AuthController@resetPassword');
        
    });
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    "middleware"=>"auth:admin,user",
    'prefix' => 'poll'
], function($router) {
    Route::get("", 'PollController@getAllPoll');
    Route::get("/{pollId}", 'PollController@getAPoll');
    Route::post("/{pollId}/vote/{choiceId}", 'VoteController@vote');

    Route::group([
        "middleware"=>"auth:admin"
    ], function() {
        Route::post("", 'PollController@createPoll');
    });

});