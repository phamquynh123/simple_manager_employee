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


Route::group(['middleware' => 'auth'], function() {
    Route::get('/admin/home', 'HomeController@home');
    Route::get('/profile', 'UserController@showProfile');
    Route::post('/editprofile', 'UserController@editprofile')->name('editprofile');
    Route::post('/changepass', 'UserController@changepass')->name('changepass');
});
