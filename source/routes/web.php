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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login', '\App\Http\Controllers\Auth\LoginController@authenticate')->name('login');
Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::get('/auth/qr_login', 'Auth\\QrLoginController@showQrReader');
Route::post('/auth/qr_login', 'Auth\\QrLoginController@login');

Route::get('auth/qr_login', 'Auth\\QrLoginController@showQrReader');   // ログインフォーム
Route::post('auth/qr_login', 'Auth\\QrLoginController@login');          // Ajax通信