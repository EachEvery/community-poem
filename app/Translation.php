<?php

namespace CommunityPoem;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['response_id', 'name', 'city', 'content', 'prompt', 'lang'];
    protected $dates = ['approved_at'];

    /**
     * Get the response that owns the translation.
     */
    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
