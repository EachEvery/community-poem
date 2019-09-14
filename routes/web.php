<?php

use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\URL;
use Display\Space;

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

<<<<<<< HEAD
Route::view('/', 'peacePoemHome')->name('about');
Route::view('/contest', 'peacePoemContest')->name('contest');
Route::view('/responses', 'peacePoemResponses')->name('responses');

=======
Route::view('/', 'peacePoemAbout')->name('about');
Route::view('/responses', 'peacePoemResponses')->name('responses');
Route::view('/contest', 'peacePoemContest')->name('contest');
>>>>>>> 130009befaf0a3774e2d417e88d324c0fef513a9

Route::get('/moderate', function () {
    if ('local' !== config('app.env')) {
        abort(404);
    }

    return redirect(URL::signedRoute(
        'approveResponses',
        ['space' => Space::inRandomOrder()->first()->slug]
    ));
});

Route::prefix('/{space}')->group(function ($router) {
    $router->get('/', 'SpaceResponseController@show');
    $router->get('/slideshow', 'SpaceSlideshowController@show');

    /*
     * Only allow users to access this route
     * that recieved a signed url from an email
     * generated from our system.
     */
    $router->get('/approve-responses', 'ApproveResponseController@show')
        ->middleware([ValidateSignature::class])->name('approveResponses');

    $router->post('/responses/{response}/approve', 'ApproveResponseController@store')->name('markResponseApproved');
    $router->delete('/responses/{response}', 'ResponseController@delete')->name('discardResponse');
});
