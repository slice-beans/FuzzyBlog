<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'SiteController@showHome');

Route::resource('sessions', 'SessionController');
Route::get('login',  'SessionController@create');
Route::get('logout', 'SessionController@destroy');

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() 
{
	Route::get('/', array('as' => 'admin', function()
	{
		return View::make('admin.dashboard');
	}));

	Route::get('/site/edit', 'SiteController@showAdmin');
	Route::post('/site/update', 'SiteController@update');

	Route::get('/post/status', 'PostsController@switchStatus');
	Route::get('/comment/status', 'CommentsController@switchStatus');
	Route::post('/comment/reply', 'CommentsController@newReply');
	Route::resource('posts', 'PostsController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('comments', 'CommentsController');
	
	Route::get('/facebook/connect', 'FacebookController@index');
	Route::get('/facebook/connect/store', 'FacebookController@store');
	Route::get('/facebook/post', 'FacebookController@postToFacebook');

});

Route::post('/post/{postid}/comment/store', 'CommentsController@publicStoreNew');
Route::post('/post/{postid}/comment/{id}/reply', 'CommentsController@publicStoreReply');

Route::get('/archive/{year}/{month?}', 'PostsController@findAllByDate');
Route::get('/category/{slug}', 'CategoriesController@showBySlug');
Route::get('/{slug}', 'PostsController@showBySlug');