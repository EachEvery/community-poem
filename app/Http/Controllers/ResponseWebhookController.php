<?php

namespace Display\Http\Controllers;

use Display\Http\Requests\TypeformWebhook;
use Display\Repositories\Responses;

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
