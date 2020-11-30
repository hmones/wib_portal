<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', 'PostController@index')->name('home');
Route::get('/posts', 'PostController@indexAPI')->name('posts.get.api');
Route::post('/post', 'PostController@store')->name('post.store');
Route::delete('/post/{post}', 'PostController@destroy')->middleware('can:delete,post')->name('post.destroy');
Route::post('/reaction', 'ReactionController@store')->name('reaction.store');
Route::delete('/reaction/{reaction}', 'ReactionController@destroy')->middleware('can:delete,reaction')->name('reaction.destroy');

Route::get('/post/{post}/comments', 'CommentController@index')->name('comments.get.api');
Route::post('/comment','CommentController@store')->name('comment.store');
Route::delete('/comment/{comment}', 'CommentController@destroy')->middleware('can:delete,comment')->name('comment.destroy');

Route::prefix('profile/entities')->as('profile.entities')->group(function () {
    Route::get('/', 'EntityController@indexUser');
    Route::post('/associate', 'EntityController@associateEntity')->name('.associate');
    Route::post('/{entity}/disassociate', 'EntityController@disassociateEntity')->name('.disassociate');
});

Route::get('/entity/create', 'EntityController@create')->name('entity.create');
Route::post('/entity', 'EntityController@store')->name('entity.store');
Route::get('/entity/{entity}-{slug}/edit', 'EntityController@edit')->name('entity.edit')->middleware('can:update,entity');
Route::put('/entity/{entity}-{slug}', 'EntityController@update')->name('entity.update')->middleware('can:update,entity');
Route::delete('/entity/{entity}-{slug}', 'EntityController@destroy')->name('entity.destroy')->middleware('can:delete,entity');


Route::get('notifications', 'HomeController@notifications')->name('notifications');

Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profiles', 'ProfileController@indexApi')->name('profiles.get.api');
Route::get('/profile/{profile}-{slug}', 'ProfileController@show')->name('profile.show');
Route::get('/profile/{profile}-{slug}/edit', 'ProfileController@edit')->name('profile.edit')->middleware('can:update,profile');
Route::put('/profile/{profile}-{slug}', 'ProfileController@update')->name('profile.update')->middleware('can:update,profile');
Route::delete('/profile/{profile}-{slug}', 'ProfileController@destroy')->name('profile.destroy')->middleware('can:delete,profile');


Route::get('/entities/search', 'EntityController@search');

Route::post('/photos', 'PhotoController@store')->name('photos.store');
Route::put('/photos/{photo}', 'PhotoController@update')->name('photos.update');
Route::delete('/photos/{photo}', 'PhotoController@destroy')->name('photos.destroy');