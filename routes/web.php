<?php

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

Route::get('/', 'FrontController@index')->name('front');
Route::get('/category_num/{id}', 'FrontController@categoryPosts')->name('categoryPosts');
Route::get('/post_num/{id}', 'FrontController@viewPost')->name('viewPost');
Route::get('/tag_num/{id}', 'FrontController@tagPosts')->name('tagPosts');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/post','PostController');
    Route::resource('/category','CategoryController');
    Route::resource('/tag','TagController');
    Route::get('/category_number/{id}', 'PostController@categoryPostsAdmin')->name('categoryPostsAdmin');
    Route::get('/tag_number/{id}', 'PostController@tagPostsAdmin')->name('tagPostsAdmin');
});


