<?php

namespace CommunityPoem\Http\Controllers;

use CommunityPoem\Repositories\Responses;
use CommunityPoem\Repositories\Spaces;

class PeacePoemResponses
{
    public function __construct(Responses $responses, Spaces $spaces)
    {
        $this->responses = $responses;
        $this->spaces = $spaces;
    }

    public function __invoke()
    {
        $space = $this->spaces->matchingTypeformId(env('PEACEPOEM_TYPEFORM_ID', '0'));

        $page = intval(request()->route('page'));
        $offset = 100;

        return view('peacePoemResponses', [
            'responses' => filled($space) ? $this->responses->approvedForSpace($space)->slice($page*$offset,$offset-1) : collect(),
        ]);
    }
}
