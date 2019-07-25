<?php

namespace Display\Http\Controllers;

use Display\Repositories\Resposnes;
use Display\Http\Requests\TypeformWebhook;
use Illuminate\Http\Request;

class ResponseController
{
    public function __construct(Resposnes $responses)
    {
        $this->responses = $responses;
    }

    public function create(TypeformWebhook $req)
    {
        $this->responses->addToSpace(
            $req->responseFillable(),
            $req->space()
        );

        return response(200);
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
