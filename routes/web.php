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

Route::resource('/cart',"CartController");
Route::put('/cart',"CartController@empty")->name('cart.empty');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
