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

// Pages.
Route::get('/', 'PageController@home')->name('home');

// Categories Resource.
Route::resource('categories', 'CategoryController');
// Remove Category Posts Only
Route::delete('categories/{category}/posts/destroy', 'CategoryController@postsDestroy')->name('categories.posts.destroy');
// List Category Comments
Route::get('categories/{category}/comments/', 'CategoryController@comments')->name('categories.comments');
// Remove Category Comments Only
Route::delete('categories/{category}/comments/destroy', 'CategoryController@commentsDestroy')->name('categories.comments.destroy');


// Posts Resource.
Route::resource('posts', 'PostController')->except(['index']);
// Remove Uploaded File
Route::delete('posts/{post}/uploads/destroy', 'PostController@uploadsDestroy')->name('posts.uploads.destroy');
// Remove Post Comments Only
Route::delete('posts/{post}/comments/destroy', 'PostController@commentsDestroy')->name('posts.comments.destroy');

// Comment Resource.
Route::resource('comments', 'CommentController')->only(['create','store']);