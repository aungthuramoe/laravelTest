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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
// Route::post('/posts', 'PostController@addPost');
//Route::get('/posts', 'PostController@showPost');
Route::apiResource('/posts','API\PostController');
Route::post('/posts/search','API\PostController@searchPost');
Route::post('/import','API\PostController@import');
Route::apiResource('/users','API\UserController');
Route::get('/user/info','API\UserController@info');
Route::post('/vuelogin','API\LoginController@login');
Route::post('/user/logout','API\LoginController@logout');

// Route::group(['prefix' => 'post'], function () {
//     Route::post('add', 'PostController@add');
//     Route::get('edit/{id}', 'PostController@edit');
//     Route::post('update/{id}', 'PostController@update');
//     Route::delete('delete/{id}', 'PostController@delete');
// });
