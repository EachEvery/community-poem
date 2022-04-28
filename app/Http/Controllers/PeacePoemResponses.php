<?php

namespace CommunityPoem\Http\Controllers;

use CommunityPoem\Repositories\Responses;
use CommunityPoem\Repositories\Spaces;
use CommunityPoem\Language;

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

        return view('peacePoemResponses', [
            'languages' => Language::select('code', 'language')->get()->keyBy('code'),
            'responses' => filled($space) ? $this->responses->approvedForSpace($space, 100) : collect(),
            'space' => optional($space),
        ]);
    }
}
