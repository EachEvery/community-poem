<?php

namespace Display\Http\Controllers;

use Illuminate\Http\Request;

class ResponseApprovalController
{
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
    }

    public function store(Request $req)
    {
        $id = $req->route('response');

        return tap($this->responses->findOrFail($id), function ($response) {
            $this->responses->approve($response);
        });
    }

    public function show(Request $req)
    {
        return view('pages.approveResponse', [
            'response' => $this->responses->findOrFail(
                $req->route('response')
            ),
        ]);
    }
}
