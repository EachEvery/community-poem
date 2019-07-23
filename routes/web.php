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

Route::get('/webhook', 'ResponseController@store');
Route::delete('/moderate/{response}', 'ResponseController@delete');
Route::get('/moderate/{response}', 'ResponseApprovalController@show');
Route::post('/moderate/{response}', 'ResponseApprovalController@store');
