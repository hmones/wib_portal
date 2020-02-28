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

use App\Country;
use App\Http\Resources\Country as CountryResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->middleware(['auth', 'verified'])->name('home');

Route::prefix('profile/entities')->as('profile.entities')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'EntityController@indexUser');
    Route::post('/associate', 'EntityController@associateEntity')->name('.associate');
    Route::post('/{entity}/disassociate', 'EntityController@disassociateEntity')->name('.disassociate');
});

Route::resource('entity', 'EntityController')->middleware(['auth', 'verified']);

Route::get('profile/create', 'ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::post('profile/contact/{profile}', 'ProfileController@contact')->name('profile.contact')->middleware(['auth', 'verified']);

Route::resource('profile', 'ProfileController')->except(['create', 'store'])->middleware('auth');

Route::resource('profilepicture', 'ProfilePictureController');

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Route::get('/entities/search', 'EntityController@search')->middleware(['auth', 'verified']);

Auth::routes(['verify' => true]);

Route::namespace('Admin')->prefix('adminpanel')->as('admin.')->group(function () {
    Auth::routes(['register' => false]);
    Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admin')->name('home');
});

Route::delete('/images/{entity}/{photo}', 'PhotosController@destroy')->name('images.delete');
