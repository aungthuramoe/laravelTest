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
Route::get('/posts','PostsController@create');
Route::post('/posts/store','PostsController@store');
Route::put('/posts/update/{id}','PostsController@update');
Route::delete('/posts/delete/{id}','PostsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/users/confirm', 'FormController@confirmation');
Route::get('/users/create', 'FormController@create');
Route::post('/form', 'FormController@store');

Route::get('/users','UserController@index');
