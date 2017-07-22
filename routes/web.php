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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store','destroy']]);
Route::get('users-avatar/{id}/{size}', 'ImagesController@users_avatar');
Route::get('/search', 'SearchController@users');
Route::get('/friends/{user_id}','FriendsController@index')->name('friends.index');
Route::patch('/friends/{friend_id}','FriendsController@accept')->name('friends.accept');
Route::delete('/friends/{friend_id}','FriendsController@destroy')->name('friends.destroy');
Route::post('/friends/{friend_id}', 'FriendsController@add')->name('friends.add');
Route::resource('/posts','PostsController',['except' => ['index','create']]);
Route::get('/wall', 'WallsController@index');
Route::resource('/comments' , 'CommentsController',['except' =>['index','create','show']]);
Route::post('/likes', 'LikesController@add');
Route::delete('/likes/{like}','LikesController@destroy');

