<?php

use App\Http\Resources\Country as CountryResource;
use App\Models\Country;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/entity', 'EntityController@index')->name('entity.index');
Route::get('/entities', 'EntityController@indexApi')->name('entities.get.api');

Route::get('profile/create', 'ProfileController@create')->name('profile.create');

Route::post('profile', 'ProfileController@store')->name('profile.store');

Route::get('/country/{id}', function ($id) {
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

Route::post('/cookie/consent', 'HomeController@cookie')->name('cookie.consent');

Route::get('/search', 'SearchController@index')->name('web.search');

Route::get('/debug-sentry', function () {
    throw new Exception('Sentry exception test!');
});

