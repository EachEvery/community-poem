<?php

namespace Display\Http\Controllers;

use Display\Repositories\Responses;
use Illuminate\Http\Request;
use Display\Repositories\Spaces;

class ApproveResponseController
{
    public function __construct(Responses $responses, Spaces $spaces)
    {
        $this->responses = $responses;
        $this->spaces = $spaces;
    }

    public function show(Request $req)
    {
        $space = $this->spaces->matchingSlug(
            $req->route('space')
        );

        return view('reviewResponses', [
            'responses' => $space->unapproved_responses()->get(),
        ]);
    }

    public function store(Request $req)
    {
        $res = $this->responses->findOrFail(
            $req->route('response')
        );

        return $this->responses->approve(
            $res, $req->input('response')
        );
    }
}
