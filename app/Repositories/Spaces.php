<?php

namespace Display\Repositories;

class Spaces
{
    public function matchingTypeformId($id)
    {
        return Space::whereTypeformId($id)->firstOrFail();
    }

    public function matchingSlug($slug)
    {
        return Space::whereSlug($slug)->firstOrFail();
    }
}
