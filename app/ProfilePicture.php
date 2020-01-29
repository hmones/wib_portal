<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    protected $guarded = [];

    /**
     * Get the owning profileable model.
     */
    public function profileable()
    {
        return $this->morphTo();
    }

    public function scopeThumbnail($query)
    {
        return $query->where('resolution','180')->first();
    }

    public function scopeOriginal($query)
    {
        return $query->where('resolution','original')->first();
    }
}
