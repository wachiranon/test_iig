<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'HomeController@index')->name('home');
Route::post('/login','HomeController@login')->name('login');

Route::post('/validatelogin','UserController@validatelogin')->name('validate_login');
Route::post('/validateregister','UserController@validateregister')->name('validate_register');
Route::post('/editProfile','UserController@editprofile')->name('edit_profile');

