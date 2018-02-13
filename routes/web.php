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
Route::get('/category/post/{id}','PostController@create2')->name('post_cat.create');

Route::post('/post/{id}/comment}','Postcontroller@storeComment')->name('comment.store');

Route::post('/contact/send','PostController@sendEmail')->name('email');

Route::resource('/tag','TagController');

Route::get('/tags/edit','TagController@getEdit')->name('tag.edit_index');

Route::resource('/category','CategoryController');

Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('/','PagesController@getIndex');

Route::get('/about','PagesController@getAbout');

Route::get('/contact','PagesController@getContact');

Route::resource('post','PostController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
