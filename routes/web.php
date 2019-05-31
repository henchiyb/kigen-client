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

Route::post('/scan','AjaxController@scanQrCode');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('/login', function () {
    return view('form_login');
})->name('login');

Route::get('/register', function () {
    return view('form_register');
})->name('register');

Route::get('/profile', 'Auth\\LoginController@profile')->name('profile');
Route::get('/histories/{id}', 'HistoryController@getHistory')->name('history')->middleware('check_login');
Route::get('/farms/{id}', 'FarmController@show')->name('show-farm')->middleware('check_login');
Route::get('/products/{id}', 'ProductController@show')->name('show-product')->middleware('check_login');
Route::get('/users/{id}', 'Auth\\LoginController@otherProfile')->name('other-profile')->middleware('check_login');
Route::get('select2-autocomplete-ajax/{id}', 'PackageController@dataCreateAjax');

Route::get('/create', function () {
    return view('form_package_create');
});

Route::get('/transfer', function () {
    return view('form_transfer');
});

Route::get('products', 'PackageController@getHoldingProduct')->name('holding-products');

Route::get('admin', 'ManagerController@index');
Route::get('admin/products', 'ManagerController@showProducts')->name('admin-products');
Route::get('admin/packages', 'ManagerController@showProductsPackage')->name('admin-packages');
Route::get('admin/farms', 'ManagerController@showFarms')->middleware('check_user_role:' . \App\Role\Role::ROLE_FARM_MANAGER);
Route::get('admin/stores', 'ManagerController@showStores')->middleware('check_user_role:' . \App\Role\Role::ROLE_STORE_MANAGER);

Route::get('employer', 'ManagerController@showEmployers')->name('all-employers')->middleware('check_user_role:' . \App\Role\Role::ROLE_MANAGER);
Route::get('employer/farmer', 'ManagerController@showFarmers')->name('farmer-employers');
Route::get('employer/transportation', 'ManagerController@showTransportationEmployers')->name('transportation-employers');
Route::get('employer/store', 'ManagerController@showStoreEmployers')->name('store-employers');

Route::get('manager', 'ManagerController@showManagers')->name('all-managers');
Route::get('manager/farmer', 'ManagerController@showFarmerManagers')->name('farmer-managers');
Route::get('manager/transportation', 'ManagerController@showTransportationManagers')->name('transportation-managers');
Route::get('manager/store', 'ManagerController@showStoreManagers')->name('store-managers');

Route::post('/register', 'Auth\\RegisterController@register')->name('post-register');
Route::post('/login', 'Auth\\LoginController@login')->name('post-login');
Route::post('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::post('/profile', 'Auth\\LoginController@setPermission')->name('upload-permission');
Route::post('/create', 'PackageController@create')->name('post-create-package');
Route::post('/transfer', 'PackageController@transfer')->name('post-transfer');

Route::post('storeEmployer/active','ManagerController@activeRoleStoreEmployer')->name('active-store-employer');
Route::post('storeEmployer/delete','ManagerController@activeRoleStoreEmployer')->name('delete-store-employer');
