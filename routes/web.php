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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'api.token'], function () {
    Route::post('enterprise', 'EnterController@create');
    Route::delete('enterprise/{id}', 'EnterController@delete');
    Route::get('/enterprise/{page}/{limit}', 'EnterController@all');
    Route::get('/enterprise/{id}', 'EnterController@show');
    Route::put('enterprise/{id}', 'EnterController@put');
    Route::get('/enterprises', 'EnterController@alls');


    Route::post('/user', 'UserController@create');
    Route::delete('/user/{id}', 'UserController@delete');
    Route::get('/user/show/{id}', 'UserController@show');
    Route::get('/user/{page}/{limit}', 'UserController@all');
    Route::put('user/{id}', 'UserController@put');
});

Route::post('/user/login', 'UserController@login');