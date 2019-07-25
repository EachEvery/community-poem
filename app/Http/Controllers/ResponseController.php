<?php

namespace Display\Http\Controllers;

use Display\Repositories\Responses;
use Illuminate\Http\Request;

class ResponseController
{
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
    }

    public function delete(Request $req)
    {
        $response = $this->responses->findOrFail(
            $req->route('response')
        );

        $this->responses->delete($response);

        return response(200);
    }
}
