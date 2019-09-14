<?php

namespace CommunityPoem\Http\Controllers;

use CommunityPoem\Repositories\Responses;
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
