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

use App\Room;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::post('/chat/callback', 'ChatController@callback')->name('chat.callback');
Route::get('/chat', 'ChatController@index');

Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');