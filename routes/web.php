<?php

use App\Country;
use App\Entity;
use App\Http\Resources\Country as CountryResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'EntityController@index')->name('entity.index');

Route::get('profile/create', 'ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::resource('profilepicture', 'ProfilePictureController')->except(['index','create','edit','show','update']);

Route::resource('photos', 'PhotosController')->except(['index','create','edit','show'])->middleware(['auth', 'verified']);

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Route::post('/cookie/consent', 'HomeController@cookie')->name('cookie.consent');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', 'HomeController@index')->middleware(['auth', 'verified'])->name('home');

Route::prefix('profile/entities')->as('profile.entities')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'EntityController@indexUser');
    Route::post('/associate', 'EntityController@associateEntity')->name('.associate');
    Route::post('/{entity}/disassociate', 'EntityController@disassociateEntity')->name('.disassociate');
});

Route::resource('entity', 'EntityController')->except(['index', 'show'])->middleware(['auth', 'verified']);


Route::post('profile/contact/{profile}', 'ProfileController@contact')->name('profile.contact')->middleware(['auth', 'verified']);

Route::resource('profile', 'ProfileController')->except(['create', 'store'])->middleware('auth');



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

// Route::post('/images/{entity}', 'PhotosController@store')->name('image.upload');

// Route::delete('/images/{entity}/{photo}', 'PhotosController@destroy')->name('images.delete');

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
