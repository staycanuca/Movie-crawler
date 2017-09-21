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

use Illuminate\Http\Request;
Route::get('/', function () {
    return view('index');
});

Route::post('search','MovieController@search');

Route::get('resource/{id}','MovieController@resource');

Route::get('online/{id}','MovieController@online');

Route::get('play/{id}','MovieController@play');

Route::get('down','MovieController@download');

Route::post('magnet','MovieController@magnet');