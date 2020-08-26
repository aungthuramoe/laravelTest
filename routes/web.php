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
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/custom-login', function () {
//     return view('login');
// });
// Route::get('/custom-register', function () {
//     return view('customform');
// });
// Route::get('/custom-forget-password', function () {
//     return view('forget-password');
// });

Route::get('/','PostsController@index');
Route::get('/posts','PostsController@userPost');
Route::get('/posts/create','PostsController@create');
Route::get('/posts/edit/{id}','PostsController@edit')->name('edit');
Route::post('/posts/confirm','PostsController@confirm')->name('confirm');
Route::post('/posts/update_confirm','PostsController@update_confirm')->name('update_confirm');
Route::post('/posts/store','PostsController@store');
Route::put('/posts/update','PostsController@update');
Route::delete('/posts/delete','PostsController@destroy');
Route::get('/posts/upload', 'PostsController@upload');
Route::get('posts/export', 'PostsController@export')->name('export');
Route::post('/posts/insert', 'PostsController@csvfileupload')->name('upload_csv');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('/users/confirm', 'UserController@confirmation');
Route::post('/users/confirm', 'UserController@confirm');
// Route::get('/users/confirm', 'UserController@confirm');
Route::get('/users/create', 'UserController@create');
Route::post('/users/store', 'UserController@store')->name('store');;
Route::get('/users','UserController@index');
Route::get('/profile','UserController@profile')->name('profile');
