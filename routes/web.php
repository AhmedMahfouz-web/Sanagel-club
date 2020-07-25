<?php

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

Auth::routes();

Route::get('/home', 'PostsController@index');
Route::get('/', 'PostsController@index');
Route::resource('posts', 'PostsController');
Route::resource('profile', 'ProfileController');
// Route::get('/profile/{id}', 'ProfileController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('/notifications', 'UsersController@notifications');
}); 
Route::resource('comment', 'CommentsController');
Route::resource('like', 'LikesController');
Route::get('getPosts/{count}', 'PostsController@index2');
Route::get('getPostsProfile/{count}', 'ProfileController@index2');
Route::get('getPostsProfile/{id}/{count}', 'ProfileController@show2');
