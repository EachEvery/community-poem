<?php

use CommunityPoem\Repositories\Responses;
use CommunityPoem\Space;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

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


Route::redirect('/admin', '/admin/dashboards/main');
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

Route::get('/paged/responses', function (Request $request, Responses $responses) {

    abort_unless($request->has(['offset', 'spaceId']), 403);


    $offset = $request->input('offset');
    $space_id = $request->input('spaceId');

    $space = Space::where('id', $space_id)->firstOrFail();


    $responses = $responses->approvedForSpace($space, 100, $offset);


    $htmlList = $responses->map(function ($r) use ($space, $request) {
        $isHighlighted = $request->input('highlight') == strval($r->id);
        return view('partials.responseCard', ['response' => $r, 'delay' => 40, 'space' => $space, 'isHighlighted' => $isHighlighted])->render() . view('partials.responsePrint', ['response' => $r])->render();
    });

    return $htmlList->join(' ');
});

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
    $router->get('/slideshow', 'SpaceSlideshowController@show')->name('slideshow');

    /*
     * Only allow users to access this route
     * that recieved a signed url from an email
     * generated from our system.
     */
    $router->get('/approve-responses', 'ApproveResponseController@show')
        ->middleware([ValidateSignature::class])->name('approveResponses');

    $router->post('/responses/{response}/approve', 'ApproveResponseController@store')->name('markResponseApproved');
    $router->delete('/responses/{response}', 'ResponseController@delete')->name('discardResponse');

    $router->patch('/responses/{response}/slideshow', 'ApproveResponseController@update');
});

Route::get('/{slug}', function ($slug) {
    return view('webResponses', [
        'space' => Space::where('slug', $slug)->firstOrFail()
    ]);
})->name('thread');
