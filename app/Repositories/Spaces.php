<?php

namespace Display\Repositories;

use Display\Space;
use Display\Response;

class Spaces
{
    public function matchingTypeformId($id)
    {
        return Space::whereTypeformId($id)->first();
    }

    public function matchingSlug($slug)
    {
        return Space::whereSlug($slug)->firstOrFail();
    }

    public function whereModerationNeeded()
    {
        $ids = Response::whereNull('approved_at')->pluck('space_id')->unique();

        return Space::whereIn('id', $ids)->get();
    }
}
