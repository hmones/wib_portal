<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    /**
     * Get the owning photos model.
     */
    public function photoable()
    {
        return $this->morphTo();
    }

}
