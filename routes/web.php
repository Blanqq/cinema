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
Route::get('/employee', 'EmployeePanelController@index')->middleware('is-employee');

Route::get('/movies/create/', 'MovieController@create');
Route::get('/movies/{movie}', 'MovieController@show');
Route::get('/movies/', 'MovieController@index');
Route::post('/movies/', 'MovieController@store');


Route::get('/roles', 'RoleController@index')->middleware('is-admin');
Route::get('/roles/create', 'RoleController@create')->middleware('is-admin');
Route::post('/roles', 'RoleController@store')->middleware('is-admin');
Route::delete('/roles/{role}', 'RoleController@destroy')->middleware('is-admin');
Route::get('/roles/{role}/edit', 'RoleController@edit')->middleware('is-admin');
Route::put('/roles/{role}', 'RoleController@update')->middleware('is-admin');

Route::get('/genres', 'GenreController@index')->name('genre.index')->middleware('is-employee');
Route::post('/genres', 'GenreController@store')->middleware('is-employee');
Route::get('/genres/create', 'GenreController@create')->middleware('is-employee');
Route::delete('/genres/{genre}', 'GenreController@destroy')->middleware('is-employee');
Route::get('/genres/{genre}/edit', 'GenreController@edit')->middleware('is-employee');
Route::put('/genres/{genre}', 'GenreController@update')->middleware('is-employee');

Route::get('/users', 'UserController@index')->middleware('is-admin');
Route::get('/users/{user}', 'UserController@show');
Route::patch('/roles_users/update/{user}', 'RoleUserController@update')->middleware('is-admin');

Route::get('/{cinema}', 'CinemaPageController@show');


Route::get('/home', 'HomeController@index')->name('home');
