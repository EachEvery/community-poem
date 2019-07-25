<?php

namespace Display;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = ['id'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
