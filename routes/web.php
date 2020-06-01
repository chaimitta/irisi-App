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

/*Route::get('/', function () {
   return view('welcome');
});*/

Route::get('/','WelcomeController@index')->name('welcome.show');
//Route::post('/','WelcomeController@store')->name('login.show');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.show');
Auth::routes();
//comment



