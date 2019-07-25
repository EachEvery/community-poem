<?php

namespace Display\Http\Controllers;

use Display\Repositories\Responses;
use Illuminate\Http\Request;

class ApproveResponseController
{
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
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
