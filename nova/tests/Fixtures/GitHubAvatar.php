<?php

namespace Laravel\Nova\Tests\Fixtures;

use Laravel\Nova\Contracts\Cover;
use Laravel\Nova\Fields\Field;

class GitHubAvatar extends Field implements Cover
{
    /**
     * Resolve the thumbnail URL for the field.
     *
     * @return string|null
     */
    public function resolveThumbnailUrl()
    {
        return 'https://github.com/taylorotwell.png?size=40';
    }
}
