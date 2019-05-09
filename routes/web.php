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

Auth::routes();

Route::get('/', function () {
    return view('welcome', ['cinemas' => \App\Cinema::all()]);
});

Route::get('/admin', 'AdminPanelController@index')->middleware('is-admin');
Route::get('/admin/users', 'AdminPanelUserController@index')->middleware('is-admin');

Route::get('/{cinema}', 'CinemaPageController@show');


Route::get('/home', 'HomeController@index')->name('home');
