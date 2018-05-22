<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "poll"], function(){
    Route::get("recent", "PollController@recent");
    Route::get("detail/{id}", "PollController@detail")->where("id","[0-9]+");
    Route::get("popular", "PollController@popular");
    Route::post("create", "PollController@create");

});
Route::group(["prefix" => "question"], function() {

    Route::post("vote/{id}", "QuestionController@vote")->where("id","[0-9]+");
});
