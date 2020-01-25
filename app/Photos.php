<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
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
