<?php

namespace CommunityPoem;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['status'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function getStatusAttribute()
    {
        return filled($this->approved_at) ? 'approved' : 'unapproved';
    }
}
