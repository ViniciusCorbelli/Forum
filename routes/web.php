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

Auth::routes();

//Ajax
Route::post('/updateChat', 'SiteController@updateChat')->name('site.updateChat');
Route::post('/sendChat', 'SiteController@sendChat')->name('site.sendChat');
// Página inicial
Route::get('/', 'SiteController@index')->name('site.index');
// Página de contato
Route::get('/contact', 'SiteController@contact')->name('site.contact');
Route::post('/contact/send', 'SiteController@sendContact')->name('site.contact.send');
// Páginas do blog
Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/search/', 'BlogController@search')->name('blog.search');
Route::get('/blog/category', 'BlogController@categories')->name('blog.category');
Route::get('/blog/category/{category}', 'BlogController@category')->name('blog.category.view');
Route::get('/blog/date', 'BlogController@dates')->name('blog.date');
Route::get('/blog/date/{month}/{year}', 'BlogController@date')->name('blog.date.view');
Route::get('/post/{post}', 'BlogController@show')->name('blog.view');

// Página de perfil
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')
        ->name('profile.home')->middleware('Admin');

    Route::resource('/users', 'UserController')
        ->names('profile.users')->middleware('User');
    Route::put('/users/pendency/{user}', 'UserController@pendency')->name('profile.users.pendency')->middleware('Admin');

    Route::resource('/categories', 'CategoryController')
        ->names('profile.categories')->middleware('Admin');

    Route::resource('/posts', 'PostController')
        ->names('profile.posts');
    Route::put('/posts/active/{post}', 'PostController@active')->name('profile.posts.active')->middleware('Admin');

    Route::put('/comments/{post}', 'CommentController@store')->name('blog.comment.store');
    Route::get('/comments/{comment}/create', 'CommentController@create')->name('profile.comments.create');
    Route::get('/comments/{comment}/show', 'CommentController@show')->name('profile.comments.show')->middleware('User');
    Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('profile.comments.edit')->middleware('User');
    Route::put('/comments/{comment}/update/', 'CommentController@update')->name('profile.comments.update')->middleware('User');
    Route::put('/comment/{comment}', 'CommentController@destroy')->name('profile.comments.destroy')->middleware('User');
    Route::delete('/comment/{comment}', 'CommentController@destroyBlog')->name('profile.comments.destroyBlog')->middleware('User');
});
