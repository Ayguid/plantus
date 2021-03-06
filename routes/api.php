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




Route::get('/posts/{limit?}/{userId?}', 'PostController@indexActivePosts');
Route::post('/postlikes/{id?}', 'PostLikeController@likePost');


Route::post('/upload', 'PostController@store');
Route::post('/posts/destroy/{id}', 'PostController@destroy');


Route::post('/user', 'ProfileController@edit');
