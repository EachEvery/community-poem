<?php

use CommunityPoem\Repositories\Responses;
use CommunityPoem\Space;
use CommunityPoem\Response;
use CommunityPoem\Language;
use CommunityPoem\Font;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    // $lang = $request->input('lang');
    $offset = $request->input('offset');
    $space_id = $request->input('spaceId');
    $highlightedID = $request->input('highlight');

    $space = Space::where('id', $space_id)->firstOrFail();

    $responses = $responses->approvedForSpace($space, 100, $offset, 'en', $highlightedID);

    $languages = Language::select('code', 'language')->get()->keyBy('code');

    $htmlList = $responses->map(function ($r, $key) use ($space, $languages, $request) {
        $isHighlighted = $request->input('highlight') == strval($r->id);
        return view('partials.responseCard', ['response' => $r, 'delay' => 40, 'space' => $space, 'languages' => $languages, 'isHighlighted' => $isHighlighted])->render() . view('partials.responsePrint', ['response' => $r])->render();
    });

    return $htmlList->join(' ');
});

Route::get('/paged/responses/translate/{response}/', function (Request $request, Response $response) {

    abort_unless($request->has(['lang']), 403);

    $lang = $request->input('lang');
    // $response_id = $request->input('responseId');
    // $total = $request->input('total');

    $response = $response->translateText($response, $lang);

    $space = Space::where('id', $response->space_id)->firstOrFail();

    if ('original' != $lang) {
        $language = Arr::first(json_decode($space->languages), function($value) use ($lang) {
            return str_starts_with($value, $lang . '/');
        });
        $language = explode('/', $language);
        $response->font = $language[1];
        $response->size = ( $size = Font::where('font', $language[1])->firstOrFail()->size ) ? $size : '16px';
        $response->weight = ( $weight = Font::where('font', $language[1])->firstOrFail()->weight ) ? $weight : '400';
        $response->alignment = Language::where('code', $language[0])->firstOrFail()->right_align == 1 ? 'right' : 'left';
    }

    return $response->toJson();
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

Route::get('/{slug}', function (Request $request, Responses $responses, $slug) {
    return view('webResponses', [
        'languages' => Language::select('code', 'language')->get()->keyBy('code'),
        'space' => Space::where('slug', $slug)->firstOrFail(),
        'lang' => 'original', // $request->has('lang') ? $request->input('lang') : 'original' // Set Language to the submitted text by default
        'auto_resize' => isset($_GET['auto-resize']) ? true : false
    ]);
})->name('thread');
