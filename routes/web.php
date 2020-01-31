<?php

use CommunityPoem\Space;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\URL;

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

Route::view('/', 'peacePoemAbout')->name('about');

Route::get('/', function () {
    $space = Space::where('list_domain', trim(request()->getHttpHost()))->first();

    if (empty($space)) {
        return view('peacePoemAbout');
    } else {
        return view('webResponses', [
            'space' => $space,
        ]);
    }
});

Route::view('/contest', 'peacePoemContest')->name('contest');
Route::get('/responses', 'PeacePoemResponses')->name('responses');

Route::get('/moderate', function () {
    if ('local' !== config('app.env')) {
        abort(404);
    }

    return redirect(URL::signedRoute(
        'approveResponses',
        ['space' => Space::inRandomOrder()->first()->slug]
    ));
});

Route::prefix('/spaces/{space}')->group(function ($router) {
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
