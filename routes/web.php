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

Route::get('/', 'RiddleController@index');
Route::get('/riddles/create', 'RiddleController@create');
Route::post('/riddles', 'RiddleController@store');
Route::get('/riddles/{riddle}', 'RiddleController@show');
Route::post('/riddles/{riddle}', 'RiddleController@show');