<?php

use App\Models\Country;
use App\Models\Entity;
use App\Http\Resources\Country as CountryResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'EntityController@index')->name('entity.index');
Route::get('/entities', 'EntityController@indexApi')->name('entities.get.api');

Route::get('profile/create', 'ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::resource('profilepicture', 'ProfilePictureController')->except(['index','create','edit','show','update']);

Route::post('/photos', 'PhotoController@store')->name('photos.store')->middleware(['auth', 'verified']);
Route::put('/photos/{photo}', 'PhotoController@update')->name('photos.update')->middleware(['auth', 'verified']);
Route::delete('/photos/{photo}', 'PhotoController@destroy')->name('photos.destroy')->middleware(['auth', 'verified']);

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Route::post('/cookie/consent', 'HomeController@cookie')->name('cookie.consent');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', 'PostController@index')->middleware(['auth', 'verified'])->name('home');
Route::get('/posts', 'PostController@indexAPI')->middleware(['auth', 'verified'])->name('posts.get.api');
Route::post('/post', 'PostController@store')->middleware(['auth','verified'])->name('post.store');
Route::delete('/post/{post}', 'PostController@destroy')->middleware(['auth','verified','can:delete,post'])->name('post.destroy');
Route::post('/reaction', 'ReactionController@store')->middleware(['auth','verified'])->name('reaction.store');
Route::delete('/reaction/{reaction}', 'ReactionController@destroy')->middleware(['auth','verified','can:delete,reaction'])->name('reaction.destroy');

Route::get('/post/{post}/comments', 'CommentController@index')->middleware(['auth', 'verified'])->name('comments.get.api');
Route::post('/comment','CommentController@store')->middleware(['auth','verified'])->name('comment.store');
Route::delete('/comment/{comment}', 'CommentController@destroy')->middleware(['auth','verified','can:delete,comment'])->name('comment.destroy');

Route::prefix('profile/entities')->as('profile.entities')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'EntityController@indexUser');
    Route::post('/associate', 'EntityController@associateEntity')->name('.associate');
    Route::post('/{entity}/disassociate', 'EntityController@disassociateEntity')->name('.disassociate');
});

Route::get('/entity/create', 'EntityController@create')->name('entity.create')->middleware(['auth', 'verified']);
Route::post('/entity', 'EntityController@store')->name('entity.store')->middleware(['auth', 'verified']);
Route::get('/entity/{entity}/edit', 'EntityController@edit')->name('entity.edit')->middleware(['auth', 'verified','can:update,entity']);
Route::put('/entity/{entity}', 'EntityController@update')->name('entity.update')->middleware(['auth', 'verified','can:update,entity']);
Route::delete('/entity/{entity}', 'EntityController@destroy')->name('entity.destroy')->middleware(['auth', 'verified', 'can:delete,entity']);


Route::post('profile/contact/{profile}', 'ProfileController@contact')->name('profile.contact')->middleware(['auth', 'verified']);

Route::get('/profile', 'ProfileController@index')->name('profile.index')->middleware('auth');
Route::get('/profiles', 'ProfileController@indexApi')->middleware(['auth', 'verified'])->name('profiles.get.api');
Route::get('/profile/{profile}', 'ProfileController@show')->name('profile.show')->middleware('auth');
Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit')->middleware(['auth','can:update,profile']);
Route::put('/profile/{profile}', 'ProfileController@update')->name('profile.update')->middleware(['auth','can:update,profile']);
Route::delete('/profile/{profile}', 'ProfileController@destroy')->name('profile.destroy')->middleware(['auth','can:delete,profile']);


Route::get('/entities/search', 'EntityController@search')->middleware(['auth', 'verified']);

Auth::routes(['verify' => true]);


Route::get('/entity/{entity}', 'EntityController@show')->name('entity.show');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('/admin')->name('admin.')->group(function () {

    // Dashboard Routes
    Route::get('/', 'DashboardController@index')->middleware('auth:admin')->name('home');
    Route::get('/options', 'DashboardController@indexOptions')->middleware('auth:admin')->name('options');
    Route::get('/users', 'DashboardController@indexUsers')->middleware('auth:admin')->name('users');
    Route::get('/entities', 'DashboardController@indexEntities')->middleware('auth:admin')->name('entities');
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
});

Route::resource('entityType', 'EntityTypeController')->except(['index', 'create', 'show', 'edit'])->middleware('auth:admin');

Route::resource('sector', 'SectorController')->except(['index', 'create', 'show', 'edit'])->middleware('auth:admin');

Route::prefix('/admin/api/')->middleware('auth:admin')->group(function (){
    Route::get('profile/{profile}', function (User $profile) { return $profile; });
    Route::delete('profile/{profile}', 'ProfileController@destroyAdmin');
    Route::post('profile/{profile}', 'ProfileController@verify');
    Route::get('entity/{entity}', function (Entity $entity) { return $entity; });
    Route::delete('entity/{entity}', 'EntityController@destroyAdmin');
    Route::post('entity/{entity}', 'EntityController@verify');
});
