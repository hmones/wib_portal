<?php

use App\Models\Country;
use App\Http\Resources\Country as CountryResource;
use Illuminate\Support\Facades\Route;


Route::get('/', 'EntityController@index')->name('entity.index');
Route::get('/entities', 'EntityController@indexApi')->name('entities.get.api');

Route::get('profile/create', 'ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::resource('profilepicture', 'ProfilePictureController')->except(['index','create','edit','show','update']);

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Route::post('/cookie/consent', 'HomeController@cookie')->name('cookie.consent');

Route::get('/search','SearchController@index')->name('web.search');

