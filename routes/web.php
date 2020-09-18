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

Route::get('/', 'PostController@index');
Route::post('/', 'PostController@search')->name('search');
Route::get('/posts/create', 'PostController@create');
Route::get('/posts/edit/{id}', 'PostController@edit')->name('edit');
Route::post('/posts/confirm', 'PostController@confirm')->name('confirm');
Route::post('/posts/update_confirm/{id}', 'PostController@updateConfirm')->name('update_confirm');
Route::post('/posts/store', 'PostController@store');
Route::put('/posts/update/{id}', 'PostController@update');
Route::delete('/posts/delete', 'PostController@destroy');

Route::get('/posts/upload', 'PostController@upload');
Route::get('posts/export', 'PostController@export')->name('export');
Route::post('/posts/insert', 'PostController@uploadCSV')->name('upload_csv');

Auth::routes();

Route::get('/profile', 'UserController@viewProfile')->name('profile');

Route::post('/profile/edit', 'UserController@editProfile')->name('edit-profile');
Route::get('/profile/edit', 'UserController@editProfile')->name('edit-profile');
Route::post('/profile/edit/confirm', 'UserController@updateConfirm');

Route::get('/profile/change-password', 'UserController@changePassword')->name('change-password');
Route::post('/profile/update-password', 'UserController@updatePassword')->name('update-password');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/users', 'UserController@index');
    Route::post('/users', 'UserController@search')->name('user-search');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users/confirm', 'UserController@confirm');
    Route::post('/users/store', 'UserController@store')->name('store');
    Route::delete('/users/delete', 'UserController@destroy');
});

Route::get('/{any}', function () {
    return view('vue');
})->where('any', '.*');

Route::prefix('auth')->group(function(){
    Route::post('/vuelogin','API\UserController@login');
    Route::post('/logout','API\UserController@logout');
});
