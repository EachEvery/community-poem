<?php

namespace CommunityPoem\Http\Controllers;

use CommunityPoem\Http\Requests\TypeformWebhook;
use CommunityPoem\Repositories\Responses;

class ResponseWebhookController extends Controller
{
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
    }

    public function store(TypeformWebhook $req)
    {
        $this->responses->addToSpace(
            $req->responseFillable(),
            $req->space()
        );

        return response(200);
    }
}
