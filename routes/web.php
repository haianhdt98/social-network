<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Register, Login & Logout
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

// User Profile
Route::group(['prefix' => 'user', 'middleware' =>  'auth'], function() {
    Route::get('{userId}', 'ProfileController@show')->name('profile.index');
    Route::post('{userId}/follow', 'ProfileController@followUser')->name('profile.follow');
    Route::post('{userId}/unfollow', 'ProfileController@unFollowUser')->name('profile.unfollow');
    Route::get('{userId}/followers', 'ProfileController@followers')->name('profile.followers');
    Route::get('{userId}/following', 'ProfileController@following')->name('profile.following');
    Route::get('{userId}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('{userId}/edit', 'ProfileController@update')->name('profile.update');
});

// Post
Route::post('post', 'PostController@store')->name('post.store')->middleware('auth');
Route::get('post/{postId}/edit', 'PostController@edit')->name('post.edit')->middleware('auth');
Route::put('post/{postId}', 'PostController@update')->name('post.update')->middleware('auth');
Route::get('post/{postId}', 'PostController@destroy')->name('post.delete')->middleware('auth');
Route::get('post/{postId}/like', 'PostController@like')->name('post.like')->middleware('auth');
Route::get('post/{postId}/unlike', 'PostController@unlike')->name('post.unlike')->middleware('auth');

// Comment
Route::post('comment', 'CommentController@store')->name('comment.store')->middleware('auth');

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('users', 'Admin\UserController@getUsers')->name('admin.users');
    Route::get('user/{userId}/edit', 'Admin\UserController@editUser')->name('admin.editUser');
    Route::put('user/{userId}/edit', 'Admin\UserController@updateUser')->name('admin.updateUser');
    Route::get('user/{userId}', 'Admin\UserController@destroyUser')->name('admin.deleteUser');
    
    Route::get('posts', 'Admin\PostController@getPosts')->name('admin.posts');
    Route::get('post/{postId}/edit', 'Admin\PostController@editPost')->name('admin.editPost');
    Route::put('post/{postId}', 'Admin\PostController@updatePost')->name('admin.updatePost');
    Route::get('post/{postId}', 'Admin\PostController@destroyPost')->name('admin.deletePost');
});
