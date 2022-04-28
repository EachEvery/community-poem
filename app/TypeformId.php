<?php

namespace CommunityPoem;

use Illuminate\Database\Eloquent\Model;

class TypeformId extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['space_id', 'typeform_id'];
    protected $dates = ['approved_at'];

    /**
     * Get the space that owns the typeform_id.
     */
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
