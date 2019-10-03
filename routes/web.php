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

// Posts Resource.
Route::resource('posts', 'PostController')->except(['index']);