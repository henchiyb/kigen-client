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

Route::get('/lg', function () {
    return view('form_login');
});

Route::get('/rg', function () {
    return view('form_register');
});

Route::get('/profile', function () {
    return view('user_profile');
});

Route::get('/create', function () {
    return view('form_package_create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
