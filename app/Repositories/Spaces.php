<?php

namespace CommunityPoem\Repositories;

use CommunityPoem\Space;
use CommunityPoem\TypeformId;
use CommunityPoem\Response;

class Spaces
{
    public function matchingTypeformId($id)
    {
        $space_id = TypeformId::select('space_id')->whereTypeformId($id)->get();
        return Space::find($space_id)->first();
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
