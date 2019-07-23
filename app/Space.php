<?php

namespace Display;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\Response;

class Space extends Model
{
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function approved_resposnes()
    {
        return $this->responses()->where('approved', 1);
    }
}
