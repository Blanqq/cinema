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

Route::get('/roles', 'RoleController@index')->middleware('is-admin');
Route::get('/roles/create', 'RoleController@create')->middleware('is-admin');
Route::post('/roles', 'RoleController@store');
Route::delete('/roles/{role}', 'RoleController@destroy');
Route::get('/roles/{role}/edit', 'RoleController@edit');
Route::put('/roles/{role}', 'RoleController@update');

Route::get('/users', 'UserController@index')->middleware('is-admin');
Route::get('/users/{user}', 'UserController@show');
Route::patch('/roles_users/update/{user}', 'RoleUserController@update')
    ->middleware('is-admin');

Route::get('/{cinema}', 'CinemaPageController@show');


Route::get('/home', 'HomeController@index')->name('home');
