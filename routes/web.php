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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('change/password', 'HomeController@changePasswordPage')->name('change');
Route::get('profile', 'HomeController@userProfilePage')->name('profile');
Route::post('update/password', 'HomeController@updatePassword')->name('updatepassword');
Route::post('update/profile', 'HomeController@updateProfile')->name('updateprofile');
Route::resource('users', 'Auth\\UserController');
Route::resource('product', 'ProductController');