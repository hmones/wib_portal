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

use Illuminate\Support\Facades\Route;
use App\Country;
use App\Http\Resources\Country as CountryResource;

Route::get('/', function (){
    $users = App\User::latest()->take(10)->get();
    $entities = App\Entity::latest()->take(10)->get();
    return view('home', ['users'=> $users, 'entities' =>$entities]);
})->name('home');

Route::resource('profile', 'ProfileController');

Route::resource('entity', 'EntityController');

Route::resource('profilepicture', 'ProfilePictureController');

Route::get('/country/{id}', function($id){
    return new CountryResource(Country::findOrFail($id));
})->name('country.cities.get');

