<?php

use Illuminate\Support\Facades\Route;

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
    if (Auth::check()) {
        return view('home');
    } else {
        return view('user.login');
    }

})->name('home');


Route::group(['middleware' => 'admin'], function () {
    Route::resource('/types', 'TypeController');
    Route::resource('/statuses', 'StatusController');
    Route::resource('/objects', 'ObjectController');
    Route::resource('/locations', 'LocationController');
    Route::resource('/history', 'HistoryController');
    Route::resource('/invoices', 'InvoiceController');
    Route::resource('/suppliers', 'SupplierController');

    Route::post('/history/{slug}', 'HistoryController@storeHistory')->name('history.storeH');
    Route::get('/objects/type/{slug}', 'ObjectController@showType')->name('objects.type');
    Route::post('/locationAjax', 'ObjectController@objectsByLocation')->name('objects.ajax');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/account-settings', 'UserController@settings')->name('profile.settings');
    Route::post('/account-settings', 'UserController@storeSettings')->name('profile.store');
});

Route::group(['middleware' => 'admin'], function () {
//    Route::get('account-settings', '')
});

