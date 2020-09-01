<?php

use App\Http\Controllers\UserController;
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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostsController@index');
Route::get('/posts', 'PostsController@userPost')->name('search');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/edit/{id}', 'PostsController@edit')->name('edit');
Route::post('/posts/confirm', 'PostsController@confirm')->name('confirm');
Route::post('/posts/update_confirm/{id}', 'PostsController@update_confirm')->name('update_confirm');
Route::post('/posts/store', 'PostsController@store');
Route::put('/posts/update/{id}', 'PostsController@update');
Route::delete('/posts/delete', 'PostsController@destroy');

Route::get('/posts/upload', 'PostsController@upload');
Route::get('posts/export', 'PostsController@export')->name('export');
Route::post('/posts/insert', 'PostsController@uploadCSV')->name('upload_csv');

Auth::routes();

Route::get('/profile', 'UserController@viewProfile')->name('profile');

Route::post('/profile/edit', 'UserController@editProfile')->name('edit-profile');
Route::get('/profile/edit', 'UserController@editProfile')->name('edit-profile');
Route::post('/profile/edit/confirm', 'UserController@updateConfirm');

Route::get('/profile/change-password', 'UserController@changePassword')->name('change-password');
Route::post('/profile/update-password', 'UserController@updatePassword')->name('update-password');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/users', 'UserController@index')->name('user-search');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users/confirm', 'UserController@confirm');
    Route::post('/users/store', 'UserController@store')->name('store');
    Route::delete('/users/delete', 'UserController@destroy');
});
