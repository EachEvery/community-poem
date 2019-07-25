<?php

use Illuminate\Routing\Middleware\ValidateSignature;

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

Route::prefix('/{space}')->group(function ($router) {
    /*
     * Only allow users to access this route
     * that recieved a signed url from an email
     * generated from our system.
     */
    $router->get('/approve-responses', 'SpaceModerationController@show')
        ->middleware([ValidateSignature::class])->name('approveResponses');

    $router->post('/responses/{response}/approve', 'ApproveResponseController')->name('approveResponse');
    $router->delete('/responses/{response}', 'ResponseController@delete')->name('discardResponse');
});
