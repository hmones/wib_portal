<?php

use App\Models\Entity;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/options', 'DashboardController@indexOptions')->name('options');
    Route::get('/users', 'DashboardController@indexUsers')->name('users');
    Route::get('/entities', 'DashboardController@indexEntities')->name('entities');
    Route::resource('admins', 'AdminController')->only(['index', 'edit', 'update']);
});

Route::resource('entityType', 'EntityTypeController')->except(['index', 'create', 'show', 'edit']);
Route::resource('sector', 'SectorController')->except(['index', 'create', 'show', 'edit']);
Route::prefix('/api')->group(function () {
    Route::get('profile/{profile}', function (User $profile) {
        return $profile;
    });
    Route::delete('profile/{profile}', 'ProfileController@destroyAdmin');
    Route::post('profile/{profile}', 'ProfileController@verify');
    Route::get('entity/{entity}', function (Entity $entity) {
        return $entity;
    });
    Route::delete('entity/{entity}', 'EntityController@destroyAdmin');
    Route::post('entity/{entity}', 'EntityController@verify');
});





