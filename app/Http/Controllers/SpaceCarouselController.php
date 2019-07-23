<?php

use Display\Repositories\Spaces;
use Illuminate\Http\Request;

class SpaceCarouselController
{
    public function __construct(Spaces $spaces, Responses $responses)
    {
        $this->spaces = $spaces;
        $this->repsonses = $responses;
    }

    public function show(Request $req)
    {
        $space = $this->spaces->matchingSlug(
            $req->route('space')
        );

        return view('spaceCarousel', [
            'space' => $space,
            'responses' => $this->responses->approved($space),
        ]);
    }
}
