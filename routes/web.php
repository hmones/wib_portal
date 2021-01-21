<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::get('/entity/{entity}-{slug}', 'EntityController@show')->name('entity.show');