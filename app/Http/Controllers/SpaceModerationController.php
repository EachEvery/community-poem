<?php

namespace Display\Http\Controllers;

use Display\Repositories\Spaces;
use Illuminate\Http\Request;

class SpaceModerationController
{
    public function __construct(Spaces $spaces)
    {
        $this->spaces = $spaces;
    }

    public function show(Request $req)
    {
        $space = $this->spaces->matchingSlug(
            $req->route('space')
        );

        return view('approveResponses', [
            'responses' => $space->unapproved_responses()->get(),
        ]);
    }
}
