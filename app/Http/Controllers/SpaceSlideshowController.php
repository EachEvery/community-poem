<?php

namespace CommunityPoem\Http\Controllers;

use CommunityPoem\Repositories\Spaces;
use Illuminate\Http\Request;
use CommunityPoem\Repositories\Responses;

class SpaceSlideshowController
{
    public function __construct(Spaces $spaces, Responses $responses)
    {
        $this->spaces = $spaces;
        $this->responses = $responses;
    }

    public function show(Request $req)
    {
        $space = $this->spaces->matchingSlug(
            $req->route('space')
        );

        return view('spaceSlideshow', [
            'space' => $space,
            'responses' => $this->responses->approvedForSlideshow($space),
            'autoplay' => 'true',
            'orientation' => $req->has('orientation') ? $req->orientation : 'landscape'
        ]);
    }
}
