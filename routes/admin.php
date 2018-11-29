<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('users', 'UserController@index')->name('users');
Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
Route::patch('users/{uuid}', 'UserController@restore')->name('users.restore');
