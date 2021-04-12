<?php

namespace CommunityPoem;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['status'];
    protected $dates = ['approved_at'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function getIsApprovedAttribute()
    {
        return filled($this->approved_at);
    }

    public function getStatusAttribute()
    {
        return filled($this->approved_at) ? 'approved' : 'unapproved';
    }

    public function getMatchOnAttribute()
    {
        return static::matchBase64String($this->name, $this->city, $this->created_at);
    }

    public static function matchBase64String($name, $city, $carbon)
    {
        return base64_encode(sprintf('%s.%s.%s', strtolower(trim($name ?? 'empty')), strtolower(trim($city ?? 'empty')), $carbon->format('Y-m-d-H')));
    }

    public function getUrl()
    {
        return route('thread', ['slug' => $this->space->slug]) . '?highlight=' . $this->id;
    }
}
