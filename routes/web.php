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
Route::get('/comments_view/{id}', 'CommentController@CommentsView')->name('commentsView');
Route::post('/comment_create', 'CommentController@CommentCreate')->name('commentCreate');
Route::delete('/comment_delete/{id}', 'CommentController@CommentDelete')->name('commentDelete');
Route::get('/sub_comments_view/{id}', 'CommentController@SubCommentsView')->name('subCommentsView');

Auth::routes();

Route::group(['prefix' => 'admin-page','namespace' => 'Auth\AdminPage', 'middleware' => ['auth','role']],function (){
    Route::get('/admin_home', 'AdminController@AdminHome')->name('adminHome');
    Route::get('/all_users', 'AllUsersController@index')->name('allUsers');
    Route::get('/edit_user/{id}', 'AllUsersController@edit')->name('editUser');
    Route::put('/update_user/{id}', 'AllUsersController@update')->name('updateUser');
    Route::delete('/delete_user/{id}', 'AllUsersController@delete')->name('deleteUser');
    Route::resource('/a_post', 'AllPostsController');
    Route::get('/tag_posts_admin/{id}', 'AllPostsController@TagPostsAdmin')->name('tagPostsAdmin');
    Route::get('/user_posts_admin/{id}', 'AllPostsController@UserPostsAdmin')->name('userPostsAdmin');
    Route::get('/all_comments', 'AllCommentsController@index')->name('allComments');
    Route::get('/all_sub_comments/{id}', 'AllCommentsController@AllSubComments')->name('allSubComments');
    Route::delete('/delete_comment/{id}', 'AllCommentsController@DeleteComment')->name('deleteComment');
});

Route::middleware('auth')->group(function () {
    Route::get('/my_posts', 'FrontController@MyPosts')->name('myPosts');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::resource('/post','PostController');
    Route::resource('/category','CategoryController');
    Route::resource('/tag','TagController');
    Route::put('/update_profile','UserController@update')->name('updateProfile');
});


