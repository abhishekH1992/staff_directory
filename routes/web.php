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

Route::get('/', 'StaffController@index');

Route::resource('staff', 'StaffController');
Route::resource('department', 'DepartmentController');

Route::post('/uploadFile', 'StaffController@upload');