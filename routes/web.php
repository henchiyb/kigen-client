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

Route::get('/login', function () {
    return view('form_login');
})->name('login');

Route::get('/register', function () {
    return view('form_register');
})->name('register');

Route::get('/profile', 'Auth\\LoginController@profile')->name('profile');
Route::get('/histories/{id}', 'HistoryController@getHistory')->name('history');
Route::get('/farms/{id}', 'FarmController@show')->name('show-farm');
Route::get('/users/{id}', 'Auth\\LoginController@otherProfile')->name('other-profile');



Route::get('/create', function () {
    return view('form_package_create');
});

Route::get('/transfer', function () {
    return view('form_transfer');
});

Route::post('/register', 'Auth\\RegisterController@register')->name('post-register');
Route::post('/login', 'Auth\\LoginController@login')->name('post-login');
Route::post('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::post('/profile', 'Auth\\LoginController@setPermission')->name('upload-permission');
Route::post('/create', 'PackageController@create')->name('post-create-package');
Route::post('/transfer', 'PackageController@transfer')->name('post-transfer');


