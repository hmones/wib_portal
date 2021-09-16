<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::get('/entity/{entity}-{slug}', 'EntityController@show')->name('entity.show');

Route::resource('rounds.service-providers', 'B2bApplicationController')->only(['create', 'store', 'index']);

Route::fallback(function () {
    return view('errors.404');
});
