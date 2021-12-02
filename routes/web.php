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

Route::get('/', 'RiddleController@top');
Route::prefix('riddles')->group(function () {
    Route::get('index/least', 'RiddleController@index');
    Route::get('create', 'RiddleController@create');
    Route::get('{riddle}', 'RiddleController@show')->name('riddle.detail');
    Route::get('{riddle}/review', 'ReviewController@show')->middleware('auth');
    Route::get('{riddle}/review/index', 'ReviewController@review_index');
    Route::post('', 'RiddleController@store');
    Route::post('{riddle}/review', 'ReviewController@store');
    Route::post('{riddle}/answer', 'RiddleController@answer');
    Route::post('{riddle}', 'RiddleController@show');
    Route::delete('{riddle}/delete', 'RiddleController@delete');
});
Auth::routes();
Route::get('/users/mypage', 'UserController@mypage');
Route::get('/users/{user}', 'UserController@user_riddles');
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/home', 'HomeController@index')->name('home');
