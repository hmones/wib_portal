<?php

use Illuminate\Support\Facades\Route;

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