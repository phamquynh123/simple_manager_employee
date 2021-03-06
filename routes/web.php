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

    Route::prefix('/room')->name('room.')->group(function() {
        Route::get('/', 'RoomController@index');
        Route::get('/roomDatatable', 'RoomController@roomDatatable')->name('table');
        Route::post('/add', 'RoomController@store')->name('add');
        Route::get('/detail/{id}', 'RoomController@detail')->name('detail');
        Route::get('/edit/{id}', 'RoomController@edit')->name('edit');
        Route::post('/update/{id}', 'RoomController@update')->name('update');
        Route::get('/delete/{id}', 'RoomController@destroy')->name('delete');
    });

    Route::prefix('/employee')->name('nv.')->group(function() {
        $ctl = 'UserController';
        Route::get('/', $ctl . '@index');
        Route::get('/datatable', $ctl .'@employeeDatatable')->name('table');
        Route::get('/repass', $ctl . '@repass')->name('repass');
        Route::post('/add', $ctl . '@store')->name('add');
        Route::post('/ResetPassOne/{id}', $ctl . '@ResetPassOne')->name('resetPassOne');
        Route::get('/getinfoToChangePass', $ctl . '@getinfoToChangePass')->name('getinfoToChangePass');
        Route::post('/resetPassGroup', $ctl . '@resetPassGroup')->name('resetPassGroup');
        Route::get('/editinfo/{id}', $ctl . '@editinfo')->name('editinfo');
        Route::post('/updateinfo/{id}', $ctl . '@updateinfo')->name('updateinfo');
    });

    Route::get('/employeeList', 'UserController@employeeList');
    Route::get('/listEmployeeByRoom', 'UserController@listEmployeeByRoom')->name('listEmployeeByRoom');
});
