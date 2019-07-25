<?php

namespace Display\Http\Controllers;

use Display\Repositories\Resposnes;
use Illuminate\Http\Request;

class ApproveResponseController
{
    public function __construct(Resposnes $responses)
    {
        $this->responses = $responses;
    }

    public function __invoke(Request $req)
    {
        $res = $this->responses->findOrFail(
            $req->route('response')
        );

        return $this->responses->approve(
            $res, $req->input('response')
        );
    }
}
