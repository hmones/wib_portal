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
    $profileRoute = 'profile/{profile}';
    $entityRoute = 'entity/{entity}';
    Route::get($profileRoute, function (User $profile) {
        return $profile;
    });
    Route::delete($profileRoute, 'ProfileController@destroyAdmin');
    Route::post($profileRoute, 'ProfileController@verify');
    Route::get($entityRoute, function (Entity $entity) {
        return $entity;
    });
    Route::delete($entityRoute, 'EntityController@destroyAdmin');
    Route::post($entityRoute, 'EntityController@verify');
});





