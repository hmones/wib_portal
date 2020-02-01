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
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Route::get('profile/create','ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::get('profile/settings', 'ProfileController@settings')->name('profile.settings')->middleware('auth');

Route::resource('profile', 'ProfileController')->except(['create','store'])->middleware('auth');

Route::get('entity/create','EntityController@create')->name('entity.create');

Route::post('entity', 'EntityController@store')->name('entity.store');

Route::resource('entity', 'EntityController')->except(['create','store'])->middleware('auth');

Route::get('entity/user/{user}', 'EntityController@showUser')->name('entity.show.user')->middleware('auth');

Route::resource('profilepicture', 'ProfilePictureController');

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Auth::routes();

Route::namespace('Admin')->prefix('adminpanel')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admin')->name('home');
});
