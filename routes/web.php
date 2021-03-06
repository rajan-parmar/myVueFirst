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

Route::get('/', 'VueFirstController@index');
Route::get('/todo', 'VueFirstController@todoList');
Route::post('/store', 'VueFirstController@store');
Route::post('/update/{id}', 'VueFirstController@update');
Route::delete('/delete/{id}', 'VueFirstController@destroy');
