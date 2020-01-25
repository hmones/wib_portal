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
}
