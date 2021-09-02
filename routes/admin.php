<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityTypeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\SectorController;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/options', [DashboardController::class, 'indexOptions'])->name('options');
Route::get('/users', [DashboardController::class, 'indexUsers'])->name('users');
Route::get('/entities', [DashboardController::class, 'indexEntities'])->name('entities');
Route::resource('admins', AdminController::class)->only(['index', 'edit', 'update']);
Route::resource('impersonate', ImpersonateController::class)->only(['store', 'index']);
Route::resource('entityType', EntityTypeController::class)->except(['index', 'create', 'show', 'edit']);
Route::resource('sector', SectorController::class)->except(['index', 'create', 'show', 'edit']);
Route::resource('events', EventController::class);
Route::resource('rounds', RoundController::class);

Route::prefix('/api')->group(function () {
    $profileRoute = 'profile/{profile}';
    $entityRoute = 'entity/{entity}';
    Route::get($profileRoute, function (User $profile) {
        return $profile;
    });
    Route::delete($profileRoute, [ProfileController::class, 'destroyAdmin']);
    Route::post($profileRoute, [ProfileController::class, 'verify']);
    Route::get($entityRoute, function (Entity $entity) {
        return $entity;
    });
    Route::delete($entityRoute, [EntityController::class, 'destroyAdmin']);
    Route::post($entityRoute, [EntityController::class, 'verify']);
});





