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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'account'], function() {
    Route::get('/activate/{token}', 'AccountController@activate')->name('account.activation');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('/create', 'ProfileController@create')->name('profile.create');
    Route::get('/{profile}', 'ProfileController@show')->name('profile.show');
    Route::get('/{profile}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/', 'ProfileController@store')->name('profile.store');
    Route::put('/{profile}', 'ProfileController@update')->name('profile.update');
    Route::post('/username', 'ProfileController@validateUsername')->name('profile.username');
});
